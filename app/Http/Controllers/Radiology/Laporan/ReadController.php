<?php

namespace App\Http\Controllers\Radiology\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Radiology\TransactionDetail;
use App\Models\Radiology\Transaction;
use App\Models\Radiology\LaporanMaster;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifMaster;
use Carbon\Carbon;
use Bugsnag;
use DB;

class ReadController extends Controller
{
	private $departmentCode = 8;

	function __construct()
	{
		defined("RAWAT_JALAN") OR define("RAWAT_JALAN", config('const.rawat_jalan'));
		defined("RAWAT_INAP") OR define("RAWAT_INAP", config('const.rawat_inap'));
		defined("BPJS") OR define('BPJS', config('const.bpjs'));
		defined("PERUSAHAAN_KERJASAMA") OR define('PERUSAHAAN_KERJASAMA', config('const.perusahaan_kerjasama'));
		defined("PERUSAHAAN_ASURANSI") OR define('PERUSAHAAN_ASURANSI', config('const.perusahaan_asuransi'));
		defined("TUNAI") OR define('TUNAI', config('const.tunai'));
		defined("DARURAT") OR define("DARURAT", 2);
		defined("URIKKES") OR define("URIKKES", 14);
		defined("TNI_HANKAM") OR define("TNI_HANKAM", [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]);
		defined("BPJS_NON") OR define("BPJS_NON", [5, 13]);
	}

	public function getMaster($slug)
	{
		return LaporanMaster::where('slug', $slug)->first();
	}

	private function prepareClasses($dept)
	{
		$dept = explode(',', $dept);
		$classTemplate = [
			'urj' => RAWAT_JALAN,
			'igd' => DARURAT,
			'inap' => [3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
			'urk' => URIKKES
		];
		$temp = [
			'1' => 'urj',
			'2' => 'igd',
			'3' => 'inap',
			'14' => 'urk'
		];

		$nameClasses = [];

		foreach($dept as $row){
			array_push($nameClasses, $temp[$row]);
		}
		return [
			'name' => $nameClasses,
			'id' => $classTemplate
		];
	}

	public function getLaporanHarian($req, $slug){
		//HSG
		$date = $req['date'];

		$master = LaporanMaster::where('slug', $slug)->first();
		$content = json_decode($master->konten);
		try {
			$transaksi = TransactionDetail::where('status', '!=', 'ask')->whereHas('transaction', function($q) use($date, &$dept){
				$q->whereDate('result_created_at', $date);
				// $q->whereIn('class', $dept);
			})->with(['transaction.asal', 'transaction.pembayaran.perusahaan'])->get();

			$result = $this->countTransaksiHarian($transaksi, $content);
			return ['title' => $master->nama,
			'data' => $result,
			'master' => $master];
		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			if(config('app.debug'))

				return FALSE;
		}
	}

    private function countTransaksiHarian($data, $master)
    {
        $result = [];
        $dept = [RAWAT_JALAN, RAWAT_INAP];
        foreach($master as $key => $m)
        {
            if(is_array($m))
            {
                $result['FOTO_KONTRAS'] = [
                    RAWAT_JALAN => 0,
                    RAWAT_INAP => 0,
                    'total' => 0
                ];
                foreach($m as $i => $detail)
                {
                    $result['FOTO_KONTRAS'][$detail->header]['main'] = [
                        RAWAT_JALAN => 0,
                        RAWAT_INAP => 0,
                        'total' => 0
                    ];
                    foreach($detail->detail as $subdetail)
                    {
                        $result['FOTO_KONTRAS'][$subdetail->id] = [
                            RAWAT_JALAN => 0,
                            RAWAT_INAP => 0,
                            'total' => 0,
                            'origin' => $detail->header
                        ];
                    }
                }
            } else {
                $result[$key] = [
                    RAWAT_JALAN => 0,
                    RAWAT_INAP => 0,
                    'total' => 0,
                    'ids' => $m->id
                ];
            }
        }
        foreach ($data as $key => $val) {
            if(is_null($val->transaction))
            	continue;

            $asal = $val->transaction->asal->lokasi_departemen_id;
            if(!in_array($asal, $dept) || $val->transaction->pembayaran->perusahaan->tipe->slug != 'bpjs')  continue;
            $tarif = $val->tarif_id;
            switch ($val->tarif_id) {
                case in_array($tarif, $result['FOTO_POLOS']['ids']):
                $result['FOTO_POLOS'][$asal]++;
                $result['FOTO_POLOS']['total']++;
                break;
                case in_array($tarif, $result['MAMMOGRAFI']['ids']):
                $result['MAMMOGRAFI'][$asal]++;
                $result['MAMMOGRAFI']['total']++;
                break;
                case isset($tarif, $result['FOTO_KONTRAS'][$tarif]):

                $result['FOTO_KONTRAS'][$tarif][$asal]++;
                $result['FOTO_KONTRAS'][$tarif]['total']++;
                break;
                default:
                break;
            }
        }
        return $result;
    }

	public function getLaporanBulanan($req, $slug){
		//HSG
		$date = $req['date'];
		$dept = $req['dept'];
		$master = LaporanMaster::where('slug', $slug)->first();
		$content = json_decode($master->konten);

		try {
			$transaksi = TransactionDetail::where('status', '!=', 'ask')->whereHas('transaction', function($q) use($date, &$dept){
				$q->whereMonth('result_created_at', $date);
				// $q->whereIn('class', $dept);
			})->with(['transaction.asal', 'transaction.pembayaran.perusahaan'])->get();

			$result = $this->countTransaksiBulanan($transaksi, $content, $dept);
			return ['title' => $master->nama,
			'data' => $result,
			'master' => $master];
		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}

	private function countTransaksiBulanan($data, $master, $dept)
	{
		$dept = explode(',', $dept);
		$result = [];
		$result_bawah = [];
		$result_bawah['total_tni'] = 0;
		$result_bawah['total_bpjs'] = 0;
		$template = array_fill(0, 33, 0);
		$template_bawah = [
			'tni' => 0,
			'bpjs' => 0
		];
		$result_tgl = $template;
		// dd($master);
		foreach($master as $key => $m)
		{
			if(is_array($m))
			{
				$result[$key]['main'] = $template;
				foreach($m as $i => $detail)
				{
					$result_bawah[$detail->header] = $template_bawah;
					$result[$key][$detail->header]['main'] = array_merge($template, ['ids' => $detail->id]);
					foreach($detail->detail as $subdetail)
					{
						$result[$key][$subdetail->id] = $template;
					}
				}
			} else {
				$result[$key]['main'] = array_merge($template, ['ids' => $m->id]);
				$result_bawah[$key] = $template_bawah;
				if($key == "FOTO_POLOS")
				{
					foreach($dept as $d)
						$result[$key][$d] = $template;
				}
			}
		}
		
		$origin = null;
		foreach ($data as $key => $val) {
			if(is_null($val->transaction))
            	continue;
			$asal = $val->transaction->asal->lokasi_departemen_id ?? 0;
			$tgl = ltrim(substr($val->transaction->result_created_at, 8, 2), 0);	//REMOVE LEADING ZEROS AND GET DATE
			
			if(!in_array($asal, $dept) OR !isset($val->transaction->pembayaran->perusahaan->type)
				OR $val->transaction->pembayaran->perusahaan->tipe->slug == 'bpjs')	continue;
			$tarif = $val->tarif_id;
			$perusahaan = $val->transaction->pembayaran->perusahaan_id;

			switch ($val->tarif_id) {
				case in_array($tarif, $result['FOTO_POLOS']['main']['ids']):
					$origin = 'FOTO_POLOS';
					break;
				case in_array($tarif, $result['MAMMOGRAFI']['main']['ids']):
					$origin = 'MAMMOGRAFI';
					break;
				case isset($tarif, $result['FOTO_KONTRAS'][$tarif]):
					$origin = 'FOTO_KONTRAS';
					$result['FOTO_KONTRAS'][$tarif][$tgl]++;
					$result['FOTO_KONTRAS'][$tarif][32]++;
					//nambah total subheadernya
					foreach($master->FOTO_KONTRAS as $m)
					{
						if(in_array($tarif, $m->id))
						{
							$result['FOTO_KONTRAS'][$m->header]['main'][$tgl]++;
							$result['FOTO_KONTRAS'][$m->header]['main'][32]++;
							if(in_array($perusahaan, TNI_HANKAM)){
								$result_bawah[$m->header]['tni']++;
								$result_bawah['total_tni']++;
							}
							else if(in_array($perusahaan, BPJS_NON)){
								$result_bawah[$m->header]['bpjs']++;
								$result_bawah['total_bpjs']++;
							}
						}
					}
					$result_tgl[$tgl]++;
					break;
				default:
					$origin = null;
					break;
			}
			if(!is_null($origin))
			{
				$result[$origin]['main'][$tgl]++;
				$result[$origin]['main'][32]++;
				$result_tgl[$tgl]++;
				if($origin == 'FOTO_POLOS')
				{
					$result[$origin][$asal][$tgl]++;
					$result[$origin][$asal][32]++;
				}
				if($origin != 'FOTO_KONTRAS')
				{
					if(in_array($perusahaan, TNI_HANKAM)){
						$result_bawah[$origin]['tni']++;
						$result_bawah['total_tni']++;
					}
					else if(in_array($perusahaan, BPJS_NON)){
						$result_bawah[$origin]['bpjs']++;
						$result_bawah['total_bpjs']++;
					}
				}
			}
		}
		return ['main' => $result,
		'bawah' => $result_bawah,
		'tgl' => $result_tgl];
	}

	public function getHistoriHarian($req)
	{
		try {
			$dateStart = $req['dateStart'];
			$dateEnd = $req['dateEnd'];
			$classUtil = $this->prepareClasses($req['dept']);
			$targetClasses = [];
			foreach($classUtil['name'] as $name){
				if($name == 'inap')
					$targetClasses = array_merge($targetClasses, $classUtil['id'][$name]);
				else
					array_push($targetClasses, $classUtil['id'][$name]);
			}
			$result = Transaction::where('status', 1)->whereDate('result_created_at', '>=', $dateStart)
			->whereDate('result_created_at', '<=', $dateEnd)->whereIn('class', $targetClasses)->with(['pasien', 'pembayaran.perusahaan'])->get();
			// $result = TransactionDetail::where('status', '!=', 'ask')->whereHas('transaction', function($q) use($dateStart, $dateEnd, &$targetClasses){
			// 	$q->whereDate('result_created_at', '>=', $dateStart)->whereDate('result_created_at', '<=', $dateEnd)->whereIn('class', $targetClasses);
			// })->with(['transaction',
			// 			'transaction.pasien'])->get();
			// foreach($result as $r){
			// 	echo $r->transaction->id."<br>";
			// }
			$result = $result->filter(function($item){
				return $item->pembayaran->perusahaan->tipe->slug == 'bpjs';
			});
			return $result;
		} catch (Exception $e) {
			if(config('app.debug'))

				return FALSE;
		}
	}

	public function getMutuFilm($start, $end)
	{
		$trans = Transaction::whereBetween(DB::raw('DATE(created_at)'), array($start, $end))->with('pasien', 'detail', 'detail.tarif')->get();
		return $trans;
	}

	public function getMutuKetepatan($start, $end, $jenis = null)
	{
		$trans = Transaction::whereBetween(DB::raw('DATE(created_at)'), array($start, $end));

		if($jenis == 'usg')
		{
			$tarif_id = TarifMaster::where('deskripsi', 'LIKE', '%USG%')->get()->map->only(['id']);
			$trans = $trans->whereHas('detail', function($q) use($tarif_id){
						$q->whereIn('tarif_id', $tarif_id);
					});
		}
		else if($jenis == 'konvensional')
		{
			$trans = $trans->TarifHistoriFilter($jenis)->where('tarif_tipe_id', config('const.tipe_cito'));
		}

		$trans = $trans->with('pasien')->get();
		return $trans;
	}
}
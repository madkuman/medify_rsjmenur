<?php

namespace App\Http\Controllers\LabPK\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\TransaksiDetail;
use App\Models\LabPK\Transaksi;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\TarifKategori;
use Carbon\Carbon;
use App\Exports\LabPK\InvoiceDiagnosis;
use App\Exports\LabPK\InvoiceRekapPasien;
use App\Models\LabPK\LaporanMaster;
use DB;

class ReadController extends Controller
{
	static protected $departemenId = 6;

	function __construct()
	{
		defined("RAWAT_JALAN") OR define("RAWAT_JALAN", config('const.rawat_jalan'));
		defined("RAWAT_INAP") OR define("RAWAT_INAP", config('const.rawat_inap'));
		defined("IGD") OR define("IGD", config('const.igd'));		
		defined("URIKKES") OR define("URIKKES", config('const.urikkes'));
		defined("AL") OR define("AL", config('const.bpjs_tni_al'));
		defined("S_AL") OR define("S_AL", config('const.bpjs_sp_al'));
		defined("KEL_AL") OR define("KEL_AL", config('const.bpjs_kel_al'));
		defined("HANK") OR define("HANK", config('const.bpjs_purna'));
		defined("ANH") OR define("ANH", config('const.bpjs_anh'));
		defined("JMK") OR define("JMK", config('const.bpjs_jamkesmas'));
		defined("MADR") OR define("MADR", config('const.bpjs_mandiri'));
		defined("ANH") OR define("ANH", config('const.bpjs_anh'));
		defined("NON_AL") OR define("NON_AL", [config('const.bpjs_tni_au'), config('const.bpjs_tni_ad'), config('const.bpjs_sp_au'), config('const.bpjs_sp_ad'),
												config('const.bpjs_kel_au'), config('const.bpjs_kel_ad')]);
		defined("UMUM") OR define("UMUM", config('const.pp_tunai'));
		defined("GOL_DARAH") OR define("GOL_DARAH", config('const.tarif_gol_darah'));

	}

	public function getMaster($slug)
	{
		return LaporanMaster::where('slug', $slug)->first();
	}

	public function getRekap($req, $slug){
		//HSG
		$date = $req['date'];

		$dept = $req['dept'];
		$str_dept = explode(',', $dept);
		$dept = "";
		foreach ($str_dept as $key => $val) {
			$dept .= (string)$val;
			if(isset($str_dept[$key+1]))
				$dept .= ",";
		}
		$master = LaporanMaster::where('slug', $slug)->first();
		$content = json_decode($master->konten);
	    $pembayaran = [
            AL,
            S_AL,
            KEL_AL,
            HANK,
            ANH,
            JMK,
            MADR,
            UMUM,
        ];
        $pembayaran = array_merge($pembayaran, NON_AL);

		try {
			$exploded_date = explode('-', $date);
			$y = $exploded_date[0];
			$m = $exploded_date[1];

			$date_start = "'".$date."-01 00:00:00'";
			$date_end = "'".$y."-".((int)$m+1)."-01 00:00:00'";
			$transaksi = DB::connection('lab_pk')->select("select count(1) as total, tarif_id, pasien_pembayaran_perusahaan as perusahaan from laporan_rekap where lokasi_departemen IN (".$dept.") AND result_created_at >= ".$date_start." AND result_created_at < ".$date_end." group by tarif_id, pasien_pembayaran_perusahaan");
			//FILTER PERUSAHAAN PEMBAYARAN
			$transaksi = collect($transaksi)->filter(function($val) use($pembayaran){
				return in_array($val->perusahaan, $pembayaran);
			});

			$result = $this->countRekap($transaksi, $content);
			return ['title' => $master->nama,
			'data' => $result,
			'master' => $master];
		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}

	private function countRekap($data, $master)
	{
		$non_array = [];	//ARRAY BUAT NYIMPAN YG GAPUNYA DETAIL
		$template = [
			AL => 0,
			S_AL => 0,
			KEL_AL => 0,
			"NON_AL" => 0,
			HANK => 0,
			ANH => 0,
			JMK => 0,
			MADR => 0,
			UMUM => 0,
			"JUMLAH" => 0
		];
		$result = [];
		$result_perusahaan = [];
		$result_perusahaan_main = $template;

		$count = [];
		// dd($data);
		$data = $data->map(function($item, $key) use(&$count){
			$count[$item->tarif_id][$item->perusahaan] = $item->total;
		});
		foreach($master as $key => $m)
		{
			if(is_array($m))
			{
				$result[$key] = $template;
				foreach($m as $i => $detail)
				{
					$result[$key][$detail->header] = [
					AL => 0,
					S_AL => 0,
					KEL_AL => 0,
					"NON_AL" => 0,
					HANK => 0,
					ANH => 0,
					JMK => 0,
					MADR => 0,
					UMUM => 0,
					"JUMLAH" => 0,
					'ids' => $detail->id
				];
					$result_perusahaan[$key][$detail->header] = [
					AL => 0,
					S_AL => 0,
					KEL_AL => 0,
					"NON_AL" => 0,
					HANK => 0,
					ANH => 0,
					JMK => 0,
					MADR => 0,
					UMUM => 0,
					"JUMLAH" => 0,
					'ids' => $detail->id
				];
					foreach($detail->detail as $subdetail)
					{
						$result[$subdetail->id] = $template;
					}
				}
			} else {
				$result[$key] = [
					AL => 0,
					S_AL => 0,
					KEL_AL => 0,
					"NON_AL" => 0,
					HANK => 0,
					ANH => 0,
					JMK => 0,
					MADR => 0,
					UMUM => 0,
					"JUMLAH" => 0,
					'ids' => $detail->id
				];
				$result_perusahaan[$key] = [
					AL => 0,
					S_AL => 0,
					KEL_AL => 0,
					"NON_AL" => 0,
					HANK => 0,
					ANH => 0,
					JMK => 0,
					MADR => 0,
					UMUM => 0,
					"JUMLAH" => 0,
					'ids' => $detail->id
				];
				array_push($non_array, $key);
			}
		}
		$origin = null;
		foreach($count as $tarif => $c)
		{
			foreach($c as $perusahaan => $total)
			{
				if(isset($result[$tarif]))
				{
					if(in_array($perusahaan, NON_AL))
					{
						$result[$tarif]["NON_AL"] += $total;

						//NAMBAH PERUSAHAAN COUNTING
						foreach($result_perusahaan as $key => $rp)
						{
							if(isset($rp['ids']))	//BUAT ANALISIS GAS DARAH
							{
								if(in_array($tarif, $rp['ids'])){
									$result_perusahaan[$key]["NON_AL"] += $total;
									$result_perusahaan[$key]["JUMLAH"] += $total;
									$result[$key]["NON_AL"] += $total;
									$result[$key]["JUMLAH"] += $total;
								}
							}
							else 	//BUAT YG LAIN
							{
								foreach($rp as $h => $header)
								{
									if(in_array($tarif, $header['ids'])){
										$result_perusahaan[$key][$h]["NON_AL"] += $total;
										$result_perusahaan[$key][$h]["JUMLAH"] += $total;

										$result[$key][$h]["NON_AL"] += $total;
										$result[$key]["NON_AL"] += $total;
										$result[$key][$h]["JUMLAH"] += $total;
										$result[$key]["JUMLAH"] += $total;
									}
								}
							}
						}
						$result_perusahaan_main["NON_AL"] += $total;
					}
					else
					{
						$result[$tarif][$perusahaan] += $total;

						//NAMBAH PERUSAHAAN COUNTING
						foreach($result_perusahaan as $key => $rp)
						{
							if(isset($rp['ids']))
							{
								if(in_array($tarif, $rp['ids'])){
									$result_perusahaan[$key][$perusahaan] += $total;
									$result_perusahaan[$key]["JUMLAH"] += $total;

									$result[$key][$perusahaan] += $total;
									$result[$key]["JUMLAH"] += $total;
								}
							}
							else
							{
								foreach($rp as $h => $header)
								{
									if(in_array($tarif, $header['ids'])){
										$result_perusahaan[$key][$h][$perusahaan] += $total;
										$result_perusahaan[$key][$h]["JUMLAH"] += $total;

										$result[$key][$h][$perusahaan] += $total;
										$result[$key][$perusahaan] += $total;
										$result[$key][$h]["JUMLAH"] += $total;
										$result[$key]["JUMLAH"] += $total;
									}
								}
							}
						}
						$result_perusahaan_main["JUMLAH"] += $total;
						$result_perusahaan_main[$perusahaan] += $total;
					}

					//END OF NAMBAH PERUSAHAAN
					$result[$tarif]["JUMLAH"] += $total;
				}
			}
		}
		return ['main' => $result,
		'perusahaan' => $result_perusahaan,
		'perusahaan_main' => $result_perusahaan_main];
	}

	public function getMutuGolonganDarah($date_start, $date_end)
	{
        $transaksi_id = TransaksiDetail::whereBetween(DB::raw('DATE(created_at)'), array($date_start, $date_end))->where('tarif_id', GOL_DARAH)
            ->groupBy('transaksi_id')->pluck('transaksi_id')->toArray();
        $transaksi = Transaksi::whereBetween(DB::raw('DATE(result_created_at)'), array($date_start, $date_end))->where('status', 1)
            ->whereIn('id',$transaksi_id)
            ->with('pasien', 'kasus', 'hasil_golongan_darah', 'asal')->get();

		return $transaksi;
	}

	public function getMutuBakteri($date_start, $date_end, $bakteri)
	{
		$tarif_kultur = TarifMaster::where('deskripsi', 'LIKE', '%Kultur%')->get()->map->only(['id']);
		$transaksi = Transaksi::where('status', 1)->whereBetween(DB::raw('DATE(result_created_at)'), array($date_start, $date_end))
						->whereHas('detail', function($q) use($tarif_kultur){
							$q->whereIn('tarif_id', $tarif_kultur);
						});
		$infeksi = 'infeksi_'.$bakteri;
		if(is_null($bakteri))
			$transaksi = $transaksi->where(function($q){
							$q->whereNotNull('infeksi_mdr')->orWhereNotNull('infeksi_aureus')->orWhere('infeksi_karbapenemase', '!=', 'Tidak Terjadi Infeksi')
							->orWhere('infeksi_esbl', '!=', 'Tidak Terjadi Infeksi');	
						});
		else if($bakteri == 'karbapenemase' || $bakteri == 'aureus')
			$transaksi = $transaksi->where($infeksi, '!=', 'TIdak Terjadi Infeksi');
		else
			$transaksi = $transaksi->whereNotNull($infeksi);
		
		$transaksi = $transaksi->with('pasien', 'kasus')->get();
		// dd($transaksi);
		return $transaksi;
	}

	public function getMutuKetepatan($start, $end, $jenis = null)
	{
		$trans = Transaksi::whereBetween(DB::raw('DATE(created_at)'), array($start, $end));

		if ($jenis == 'usg') {
			$tarif_id = TarifMaster::where('deskripsi', 'LIKE', '%USG%')->get()->map->only(['id']);
			$trans = $trans->whereHas('detail', function ($q) use ($tarif_id) {
				$q->whereIn('tarif_id', $tarif_id);
			});
		} else if ($jenis == 'konvensional') {
			$trans = $trans->TarifHistoriFilter($jenis)->where('tarif_tipe_id', config('const.tipe_cito'));
		}

		$trans = $trans->with('pasien')->get();
		return $trans;
	}
}
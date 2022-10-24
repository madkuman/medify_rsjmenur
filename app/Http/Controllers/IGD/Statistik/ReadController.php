<?php
namespace App\Http\Controllers\IGD\Statistik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Transaksi;
use App\Models\IGD\Ruangan;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Diagnosis;
use App\Models\Hospital\Lokasi;
use DB;
use Carbon\Carbon;
use DateTime;


class ReadController extends Controller{

	public function getKasusCountSeminggu($day){
		$day->copy()->startOfWeek();
		$counted = Transaksi::where('waktu_masuk', '>=', $day)
                        ->groupBy('date')
                        ->orderBy('date', 'ASC')
						->get(array(
                                DB::raw('WEEKDAY(waktu_masuk)+1 as date'),
                                DB::raw('COUNT(*) as "kasus_count"')
                            ));
		$j = 0;
		for ($i=1; $i <= 7; $i++) {
            if(!$counted->isEmpty() && $counted[$j]->date == $i){
                $data[$i]['date'] = $counted[$j]->date;
                $data[$i]['kasus_count'] = $counted[$j]->kasus_count;
                unset($counted[$j]);
                $j++;

            }else{
                $data[$i]['date'] = $i;
                $data[$i]['kasus_count'] = 0;
            }
        }
		return json_encode($data);
	}

	public function getDistribusiRujukan($day){
		//dd($day);
		//$transaksi = Transaksi::whereDate('waktu_masuk', $day)->whereNotNull('is_pasien_baru')->get(['pasien_id']);
		$rujukan = Transaksi::whereDate('waktu_masuk', $day)->whereNotNull('asal_rujukan')->count();
		$tanparujuk = Transaksi::whereDate('waktu_masuk', $day)->whereNull('asal_rujukan')->count();
		$counted[0]['label'] = 'Rujukan';
		$counted[1]['label'] = 'Tanpa Rujukan';
		$counted[0]['value'] = $rujukan;
		$counted[1]['value'] = $tanparujuk;
		return $counted;
	}

	public function getDistribusiPasienCreated($day){
		
		//$transaksi = Transaksi::whereDate('waktu_masuk', $day)->whereNotNull('is_pasien_baru')->get(['pasien_id']);
		$pasienBaru = Transaksi::whereDate('waktu_masuk', $day)->whereNotNull('is_pasien_baru')->count();
		$pasienLama = Transaksi::whereDate('waktu_masuk', $day)->whereNull('is_pasien_baru')->count();
		$counted[0]['label'] = 'Pasien Lama';
		$counted[1]['label'] = 'Pasien Baru';
		$counted[0]['value'] = $pasienLama;
		$counted[1]['value'] = $pasienBaru;
		return $counted;
	}

	public function getDistribusiPasienType(){
		
        for ($i=1; $i <=4 ; $i++) { 
            $data[$i] = [
                'type' => $i,
                'jumlah' => 0
            ];
        }
        $query = Transaksi::with('kasus.pembayaran.perusahaan.tipe')->whereHas('kasus', function($q){
                    $q->from(config('app.db_name').'_kasus.kasus')->whereHas('pembayaran', function($q2){
	                    $q2->from(config('app.db_name').'_patients.pasien_pembayaran');
	                });
                })->get();
        
        //dd($query);
        foreach ($query as $item) {
            if (!empty($item->kasus->pembayaran->perusahaan->type)) {
                $data[$item->kasus->pembayaran->perusahaan->type]['jumlah']++;
            }
        }
        //dd($data);
        return $data;
	}

	public function getDistribusiRuangan($day){
		
		$counted = Transaksi::whereDate('waktu_masuk', $day)
						->with('ruangan')
						->groupBy('ruangan_id')
						->get(array(
                                'id', 'ruangan_id',
                                DB::raw('COUNT(*) as "kasus_count"')
                            ));
        return $counted;
	}

	public function getPasienFromMonthTime($bulan,$start,$end)
	{
		//dd($start);
		$query = Transaksi::whereMonth('waktu_masuk',$bulan)->whereTime('waktu_masuk', '>=', $start)->whereTime('waktu_masuk', '<=', $end)->count();
		return $query;
	}

	public function getAllPasienFromTime($day)
	{
		$bulan = $day->copy()->month;
		$start = Carbon::createFromTime(0,0,0);
		$end = Carbon::createFromTime(3,59,0);
		for ($i=0; $i < 6 ; $i++) {
			$start_string = $start->copy()->toTimeString();
			$end_string = $end->copy()->toTimeString(); 
			$data[$i]=$this->getPasienFromMonthTime($bulan,$start_string,$end_string);
			$start->addHours(4);
			$end->addHours(4);
		}
		//dd($data);
		return $data;
	}

	public function getKunjungan(Request $request)
	{
		$date = $request->date;
		$date_end = Carbon::createFromFormat('m-Y',$date);
		$date_start = Carbon::createFromFormat('m-Y',$date)->subDays(14);
		$query = '
			SELECT SUM(1) as total, DATE(created_at) as tanggal FROM transaksi
			WHERE created_at >"'.$date_start->startOfDay()->toDateTimeString().'"
			AND created_at <= "'.$date_end->endOfDay()->toDateTimeString().'"
			GROUP BY DATE(created_at);
			';
		$data = DB::connection('igd')->select($query);

		$result_data = [];
		$total = 0;

		foreach ($data as $key => $item)
		{
			$new_date = Carbon::createFromFormat('Y-m-d',$item->tanggal);
			$temp = new \stdClass();
			$temp->kategori = $new_date->format('d M');
			$temp->value = $item->total;
			array_push($result_data, $temp);
			$total += $item->total;
		}
		$result_final['data'] = $result_data;
		$result_final['total'] = $total;

		return json_encode($result_final);
	}

	public function getSepuluhBesarPenyakit(Request $request)
	{
		$date = $request->date;
		$date_end = Carbon::createFromFormat('m-Y',$date);
		$date_start = Carbon::createFromFormat('m-Y',$date)->subDays(30);

        $sepuluhPenyakit = app('App\Http\Controllers\Admisi\ReadController')->getSepuluhBesarPenyakit(1,$date_start,$date_end);

        $result_data = [];
		$total = 0;

		foreach ($sepuluhPenyakit as $key => $item)
		{
			$temp = new \stdClass();
			$temp->kategori = $item->icd10->code_icd.'-'.$item->icd10->long_desc;
			$temp->value = $item->kasus_count;
			array_push($result_data, $temp);
			$total += $item->total;
		}
		$result_final['data'] = $result_data;
		$result_final['total'] = $total;

		return json_encode($result_final);
	}

	public function getKunjunganPerRuangan(Request $request)
	{
		$date = $request->date;
		$date_end = Carbon::createFromFormat('m-Y',$date);
		$date_start = Carbon::createFromFormat('m-Y',$date)->subMonth(12);
		$transaksi = Transaksi::whereDate('created_at', '>=', $date_start)
                    ->groupBy('month')
                    ->groupBy('ruangan_id')
                    ->orderBy('month', 'ASC')
                    ->get(array(
                            DB::raw('ruangan_id'),
                            DB::raw('MONTH(created_at) as month'),
                            DB::raw('COUNT(1) as "transaksi_count"')
                        ));

		$result_data = [];
		$total = 0;

		$ruangan = Ruangan::all();
		foreach($ruangan as $item)
		{
			$ruangan_array[$item->id] = $item->name;
		}

		foreach ($transaksi as $key => $item)
		{
			$monthNum  = 3;
			$dateObj   = DateTime::createFromFormat('!m', $item->month);
			$monthName = $dateObj->format('F');
			$ruangan = $ruangan_array[$item->ruangan_id];

			$result_data[$monthName][$ruangan]=$item->transaksi_count;
		}

		$result_data_final = [];

		foreach($result_data as $key_month => $month_value)
		{
			$temp = [];
			$temp['month'] = $key_month;
			foreach($month_value as $key_ruangan => $item)
			{
				$temp[$key_ruangan] = $item;
			}
			array_push($result_data_final, $temp);
		}

		return json_encode($result_data_final);

	}

	public function getPengunjungPulang(Request $request)
	{
		$months = 6;
		$date = $request->date;
		$date_end = Carbon::createFromFormat('m-Y',$date);
		$date_start = Carbon::createFromFormat('m-Y',$date)->subMonth($months);
		$date_start_temp = $date_start->copy();

		$lokasi = Lokasi::where('lokasi_departemen_id',1)->pluck('id')->toArray();

		$result_data_final = [];

		for($i = 0;$i < $months; $i++)
		{
			$date_end_temp = $date_start_temp->copy()->endOfMonth();

			$kasus_pulang = app('App\Http\Controllers\Pasien\Laporan\PengunjungPulangController')->get($date_start_temp,$date_end_temp,$lokasi,1);
			$kasus_ranap = app('App\Http\Controllers\Pasien\Laporan\PengunjungPulangController')->get($date_start_temp,$date_end_temp,$lokasi,0);

			$temp['month'] = $date_end_temp->format('M Y');
			$temp['pulang'] = $kasus_pulang->count();
			$temp['ranap'] = $kasus_ranap->count();

			
			array_push($result_data_final, $temp);
			
			$date_start_temp->addMonth();

		}
		return json_encode($result_data_final);

	}

}
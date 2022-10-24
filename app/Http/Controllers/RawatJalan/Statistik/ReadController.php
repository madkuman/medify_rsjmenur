<?php
namespace App\Http\Controllers\RawatJalan\Statistik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Transaksi;
use App\Models\Pasien\Pasien;
use DB;
use Carbon\Carbon;


class ReadController extends Controller{

	public function getTransaksiToday($day)
	{
		$transaksi = Transaksi::whereDate('created_at', $day)->get();
		return $transaksi;
	}

	public function getDistribusiPoli(){
		$day = Carbon::today()->toDateTimeString();
// SELECT cl.`cl_boolean`, l.`l_name`
// FROM `card_legality` cl
// LEFT JOIN `legality` l ON l.`legality_id` = cl.`legality_id`
// WHERE cl.`card_id` = '23155'


		$query = "select p.name, COUNT(1) as kasus_count from transaksi t LEFT JOIN 
					poliklinik p on p.id = t.poliklinik_id where date(t.`waktu_masuk`) = ? and t.`deleted_at` is null group by t.`poliklinik_id`";
		$counted = DB::connection('rawatjalan')->select($query, [$day]);	//7.1s

		// $counted = Transaksi::whereDate('waktu_masuk', $day)
		// 				->with('poliklinik')
		// 				->groupBy('poliklinik_id')
		// 				->get(array(
  //                               'id', 'poliklinik_id',
  //                               DB::raw('COUNT(*) as "kasus_count"')
  //                           ));		//10.4

        return json_encode($counted);
	}

	public function getDistribusiPasienType(){
		
        $data = DB::connection('patients')->select("select pp.`type`, count(pp.`type`) as jumlah from ".config('app.db_name')."_rawat_jalan.transaksi t
join ".config('app.db_name')."_patients.pasien_pembayaran p on p.id=t.pasien_pembayaran_id
join ".config('app.db_name')."_patients.pembayaran_perusahaan pp on p.perusahaan_id=pp.id where t.deleted_at is null group by pp.`type`");
        
        return json_encode((array)$data);
	}

	public function getDistribusiPasienCreated(){
		$day = Carbon::today()->toDateTimeString();
		
		//$transaksi = Transaksi::whereDate('waktu_masuk', $day)->whereNotNull('is_pasien_baru')->get(['pasien_id']);
		$pasienBaru = Transaksi::whereDate('waktu_masuk', $day)->whereNotNull('is_pasien_baru')->count();
		$pasienLama = Transaksi::whereDate('waktu_masuk', $day)->whereNull('is_pasien_baru')->count();
		$counted[0]['label'] = 'Pasien Lama';
		$counted[1]['label'] = 'Pasien Baru';
		$counted[0]['value'] = $pasienLama;
		$counted[1]['value'] = $pasienBaru;
		return json_encode($counted);
	}

	public function getSepuluhBesarPoli($start,$end)
	{
		$query = Transaksi::with('poliklinik')
						->whereBetween('waktu_masuk',[$start,$end])
						->groupBy('poliklinik_id')
						->orderBy(DB::raw('count(*)'), 'DESC')
						->get(array(
                                'id', 'poliklinik_id',
                                DB::raw('COUNT(*) as "kasus_count"')
                            ));
		for ($i=0; $i < 10; $i++) 
		{ 
			if(!empty($query[$i])) $data[$i]=$query[$i];
			else $data[$i]=[];
		}

		//dd($data);
		return $data;
	}

	public function getKasusCountSeminggu(){
		$day = Carbon::today()->startOfWeek();
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


////---------------
	

	public function getKasusCountSetahun(){
		$day = Carbon::now()->startOfyear();
		$counted = Transaksi::whereNotNull('kasus_id')
						->where('ordered_at', '>=', $day)
                        ->groupBy('month')
                        ->orderBy('month', 'ASC')
						->get(array(
                                DB::raw('MONTH(ordered_at) as month'),
                                DB::raw('COUNT(*) as "kasus_count"')
                            ));
                            $j = 0;
		for ($i=1; $i <= 12; $i++) {
            if(!$counted->isEmpty() && $counted[$j]->date == $i){
                $data[$i]['month'] = $counted[$j]->date;
                $data[$i]['kasus_count'] = $counted[$j]->kasus_count;
                unset($counted[$j]);
                $j++;

            }else{
                $data[$i]['month'] = $i;
                $data[$i]['kasus_count'] = 0;
            }
        }
		return json_encode($data);
	}

	public function getTransaksiCountToday(){
		$day = Carbon::today();
		$counted[0] = Transaksi::whereDate('ordered_at', $day)
						->count();
		$counted[1] = Transaksi::whereDate('ordered_at', $day->subDay())
						->count();
		if ($counted[1] != 0 && $counted[0] != 0) {
			$counted[1] = ($counted[0]-$counted[1])/$counted[1]*100;
		}else{
			$counted[1] = 0;
		}
		return $counted;	
	}


	public function getKasusCountToday(){
		$day = Carbon::today();
		$counted[0] = Transaksi::whereDate('ordered_at', $day)
						->whereNotNull('kasus_id')
						->count();

		$counted[1] = Transaksi::whereDate('ordered_at', $day->subDay())
						->whereNotNull('kasus_id')
						->count();

		if ($counted[1] != 0 && $counted[0] != 0) {
			$counted[1] = ($counted[0]-$counted[1])/$counted[1]*100;
		}else{
			$counted[1] = 0;
		}

		return $counted;	
	}

	
}
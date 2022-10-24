<?php

namespace App\Http\Controllers\KamarOperasi\Laporan;

use DB;
use Carbon\Carbon;
use App\Models\Kasus\ICD10;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\KamarOperasi\Pasca;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Ruangan;
use App\Models\KamarOperasi\Transaksi;
use App\Models\KamarOperasi\JenisOperasi;

class ReadController extends Controller
{
    	public function getOccupancy($start_date,$end_date)
    	{

            $current_day = $start_date->copy();
    		$data = [];

    		while($current_day < $end_date)
    		{
    			$current_day_start = $current_day->copy()->startOfDay();
    			$current_day_end = $current_day->copy()->endOfDay();

    			$temp_current_day_start = $current_day_start->copy();
    			$temp_current_day_end = $current_day_end->copy();
    			
    			$data_current_date = app('App\Http\Controllers\KamarOperasi\Laporan\LaporanPenggunaanRuangan')
    			->getData($temp_current_day_start,$temp_current_day_end);
    			$result_current_date['date'] = $current_day_start->format('Y-m-d');
    			$result_current_date['duration'] = $data_current_date['global_total'];

                array_push($data, $result_current_date);

    			$current_day->addDay();
    		}
    		return $data;
    	}

        public function getOccupancyHighLevelAlert($start_date,$end_date)
        {
            $ruang_ids = Ruangan::select('id')->pluck('id');

            $transaksi = Transaksi::select(DB::raw('DATE_FORMAT(jadwal_operasi, "%Y-%m-%d") AS jadwal_operasi'), 'hasil_id')
                                  ->whereBetween('jadwal_operasi',[$start_date,$end_date])
                                  ->whereIn('ruangan_id',$ruang_ids)
                                  ->whereNotNull('hasil_id')
                                  // ->groupBy(DB::raw('DATE(jadwal_operasi)'))
                                  ->orderBy('jadwal_operasi')
                                  ->get();

            $transaksi_tiap_tanggal = $transaksi->groupBy(function($item) {
                                        return $item->jadwal_operasi->format('Y-m-d');
                                    });

            $current_day = $start_date->copy();
            $hasil_id = [];
            $data = [];

            while($current_day < $end_date)
            {
                $current_day_date = $current_day->copy()->format('Y-m-d');
                if(array_key_exists($current_day_date, $transaksi_tiap_tanggal->toArray())){

                }else{
                    $transaksi_tiap_tanggal[$current_day_date] = null;   
                }

                $current_day->addDay();
            }

            foreach ($transaksi_tiap_tanggal as $key => $value) {
                if(null !== $value){
                    $hasil_id = array_merge($hasil_id, $value->pluck('hasil_id')->toArray());
                }
            }

            $pasca = Pasca::select('id', DB::raw('TIME_TO_SEC(TIMEDIFF(waktu_selesai, waktu_mulai)) AS durasi'))
                          ->whereIn('id', $hasil_id)
                          ->get();

            $current_day = $start_date->copy();

            while($current_day < $end_date){
                $current_day_date = $current_day->copy()->format('Y-m-d');
                if(null !== $transaksi_tiap_tanggal[$current_day_date]  ){
                    $current_pasca = $pasca->whereIn('id', $transaksi_tiap_tanggal[$current_day_date]->pluck('hasil_id'))->sum('durasi');    
                }else{
                    $current_pasca = 0;
                }    

                $current_pasca =  app('App\Http\Controllers\KamarOperasi\Laporan\LaporanPenggunaanRuangan')->divideFloat($current_pasca,3600,2);

                $data[] = ["date" => $current_day_date, "duration" => $current_pasca];
                $current_day->addDay();
            }
            
            return $data;
        }

    	public function getKasusTerbanyak($start_date,$end_date)
    	{
    		$transaksi = Transaksi::with('icd10')->whereNotNull('diagnosis_id')->whereBetween('jadwal_operasi',[$start_date,$end_date])->groupBy('diagnosis_id')->select('diagnosis_id', DB::raw('count(*) as total'))->orderBy('total','desc')->take(10)->get();
        
            $data = [];
            foreach($transaksi as $item)
            {
                $diagnosis = $item->icd10;
                $temp = [];
                $temp['total'] = $item->total;
                $temp['diagnosis'] = $diagnosis->long_desc;
                $temp['icd_10_id'] = $diagnosis->code_icd;
                array_push($data, $temp);
            }
            
    		return $data;
    	}

        public function getOccupancyPerOK($start_date,$end_date)
        {
            $current_day = $start_date->copy();
            $data = [];

            $data_current_date = app('App\Http\Controllers\KamarOperasi\Laporan\LaporanPenggunaanRuangan')
            ->getData($start_date,$end_date);
            
            $occupancy = $data_current_date['total_per_ruang'];

            $data = [];
            foreach ($data_current_date['total_per_ruang'] as $key => $item) {
                    $ruangan = Ruangan::find($key);
                    $temp['total'] = $item;
                    $temp['ok'] = $ruangan->name;
                    array_push($data, $temp);
            }
            arsort($data);

            $clean_data = [];
            $count = 0;
            foreach($data as $value)
            {
                array_push($clean_data, $value);
                $count++;
                if($count > 9) break;
            }

            return $clean_data;
        }

        public function getOccupancyPerOKHighLevelAlert($start_date,$end_date)
        {
            $ruangan = Ruangan::select('id', 'name')->get();
            
            $transaksi = Transaksi::select(DB::raw('ruangan_id'), 'hasil_id')
                                  ->whereBetween('jadwal_operasi', [$start_date,$end_date])
                                  ->whereIn('ruangan_id', $ruangan->pluck('id'))
                                  ->whereNotNull('hasil_id')
                                  ->get();

            $pasca = Pasca::select('id', DB::raw('TIME_TO_SEC(TIMEDIFF(waktu_selesai, waktu_mulai)) AS durasi'))
                          ->whereIn('id', $transaksi->pluck('hasil_id'))
                          ->get();

            $hasil_id = [];
            $data = [];

            foreach ($ruangan as $key => $value) {
                $total = $pasca->whereIn('id', $transaksi->where('ruangan_id', $value->id)->pluck('hasil_id'))->sum('durasi');
                $total = app('App\Http\Controllers\KamarOperasi\Laporan\LaporanPenggunaanRuangan')->divideFloat($total,3600,2);
                if($total > 0){
                    $data[] = ["total" => $total, "ok" => $value->name];
                }
            }

            return $data;
        }

        public function getRekapJenisOperasi($tanggal_min,$tanggal_max)
        {
            $jenis_operasi = JenisOperasi::select('id', 'nama')->get();

            $transaksi = Transaksi::with('hasil.jenis')
                                  ->has('hasil')
                                  ->whereBetween('jadwal_operasi',[$tanggal_min,$tanggal_max])
                                  ->get();


            $data = [];
            $i = 0;
            foreach($jenis_operasi as $each_jenis_operasi)
            {
                $id = $each_jenis_operasi->id;

                $temp['jenis'] = $each_jenis_operasi->nama;
                $temp['total'] = $transaksi->filter(function($collection) use ($id){
                    if ($collection->hasil->jenis_operasi == $id) {
                        return $collection;
                    }    
                })->count();

                array_push($data, $temp);
            }

            return $data;
        }
}

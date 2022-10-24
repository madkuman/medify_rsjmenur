<?php

namespace App\Http\Controllers\HighLevel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Diagnosis;
use DB;
use Carbon\Carbon;

class PoliController extends Controller
{
    public function index()
    {
        $day = Carbon::today();
        $awal_bulan = $day->copy()->startOfMonth()->toDateTimeString();
        $akhir_bulan = $day->copy()->endOfMonth()->toDateTimeString();
        $hari = $day->copy()->toDateTimeString();
        $layanan = 2; //rawat jalan

        $countBulanan = app('App\Http\Controllers\RawatJalan\Statistik\ReadController')->getKasusCountSetahun();
        $countBulanan = json_decode($countBulanan);
        $countKasusToday = app('App\Http\Controllers\RawatJalan\Statistik\ReadController')->getKasusCountToday();


        $countTransaksiToday = app('App\Http\Controllers\RawatJalan\Statistik\ReadController')->getTransaksiToday($hari);
        $countKasus = app('App\Http\Controllers\RawatJalan\Statistik\ReadController')->getKasusCountSeminggu();
        $countKasus = json_decode($countKasus);
        
        $sepuluhBesar = app('App\Http\Controllers\RawatJalan\Statistik\ReadController')->getSepuluhBesarPoli($awal_bulan,$akhir_bulan);
        $sepuluhPenyakit = self::getSepuluhBesarPenyakit($layanan,$awal_bulan,$akhir_bulan);

        $data['kasusToday'] = $countKasusToday;

        $data['grafikKasus'] = $countKasus;
        $data['transaksiToday'] = $countTransaksiToday;
        $data['sepuluhBesar'] = $sepuluhBesar;
        $data['sepuluhPenyakit'] = $sepuluhPenyakit;

        return view('highlevel.poli', $data);
    }

    public function getSepuluhBesarPenyakit($layanan,$start,$end)
    {
        $query = Diagnosis::whereBetween('created_at',[$start,$end])->whereHas('kasus', function ($q) use ($layanan) {
                        $q->from(config('app.db_name').'_kasus.kasus')->whereHas('lokasi', function($q2) use ($layanan){
                            $q2->from(config('app.db_name').'_kasus.lokasi')->whereHas('lokasi',function($q3) use ($layanan){
                                $q3->from(config('app.db_name').'.lokasi')->where('lokasi_departemen_id',$layanan);//1 = igd
                        });
                    });
                })
        //->take(5)->get();
        ->groupBy('icd_10')
                        ->orderBy(DB::raw('count(*)'), 'DESC')
                        ->with('icd10')
                        ->get(array(
                                'id', 'icd_10',
                                DB::raw('COUNT(*) as "kasus_count"')
                            ));

        for ($i=0; $i < 10; $i++) 
        { 
            if(!empty($query[$i])) $data[$i]=$query[$i];
            else $data[$i]=[];
        }

        return $data;
    }
}

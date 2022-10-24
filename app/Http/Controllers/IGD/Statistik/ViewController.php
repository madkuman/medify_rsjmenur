<?php

namespace App\Http\Controllers\IGD\Statistik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ViewController extends Controller
{
    public function index()
    {
        $day = Carbon::today();
        $awal_bulan = $day->copy()->startOfMonth()->toDateTimeString();
        $akhir_bulan = $day->copy()->endOfMonth()->toDateTimeString();
        $hari = $day->copy()->toDateTimeString();
        $layanan = 1; //igd

        $countKasus = app('App\Http\Controllers\IGD\Statistik\ReadController')->getKasusCountSeminggu($day);
        $countKasus = json_decode($countKasus);
        $distribusiRujukan = app('App\Http\Controllers\IGD\Statistik\ReadController')->getDistribusiRujukan($day);
        $countPasienCreated = app('App\Http\Controllers\IGD\Statistik\ReadController')->getDistribusiPasienCreated($day);
        $countPasienType = app('App\Http\Controllers\IGD\Statistik\ReadController')->getDistribusiPasienType();
        $distribusiRuangan = app('App\Http\Controllers\IGD\Statistik\ReadController')->getDistribusiRuangan($day);
        $countPasienByTime = app('App\Http\Controllers\IGD\Statistik\ReadController')->getAllPasienFromTime($day);
        $sepuluhPenyakit = app('App\Http\Controllers\Admisi\ReadController')->getSepuluhBesarPenyakit($layanan,$awal_bulan,$akhir_bulan);

        $data['grafikKasus'] = $countKasus;
        $data['distribusiRujukan'] = $distribusiRujukan;
        $data['distribusiPasienCreated'] = $countPasienCreated;
        $data['distribusiPasienType'] = $countPasienType;
        $data['distribusiRuangan'] = $distribusiRuangan;
        $data['countPasienByTime'] = $countPasienByTime;
        $data['sepuluhPenyakit'] = $sepuluhPenyakit;

        //dd($data);
        return view('igd.statistik.index',$data);
    }

    
}

<?php

namespace App\Http\Controllers\RawatJalan\Statistik;

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

		$begin = microtime(true);

		$countKasus = app('App\Http\Controllers\RawatJalan\Statistik\ReadController')->getKasusCountSeminggu();		//5.08s
		$countKasus = json_decode($countKasus);		

		//AJAXED
		// $countPoli = app('App\Http\Controllers\RawatJalan\Statistik\ReadController')->getDistribusiPoli($hari);			//9.6s
		// $countPoli = json_decode($countPoli);
		// $countPasienType = app('App\Http\Controllers\RawatJalan\Statistik\ReadController')->getDistribusiPasienType();
		// $countPasienCreated = app('App\Http\Controllers\RawatJalan\Statistik\ReadController')->getDistribusiPasienCreated($hari);
		
		$sepuluhBesar = app('App\Http\Controllers\RawatJalan\Statistik\ReadController')->getSepuluhBesarPoli($awal_bulan,$akhir_bulan);

		// $data['kasusToday'] = $countKasusToday;

		$data['grafikKasus'] = $countKasus;
		// $data['distribusiPoli'] = $countPoli;
		// $data['distribusiPasienType'] = $countPasienType;
		// $data['distribusiPasienCreated'] = $countPasienCreated;
		$data['sepuluhBesar'] = $sepuluhBesar;
		// dd($data);
		return view('rawatjalan.statistik.index', $data);

	}
}
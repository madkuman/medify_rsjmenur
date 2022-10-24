<?php

namespace App\Http\Controllers\Gizi\DashBoard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ViewController extends Controller
{
    public function index()
    {
    	
    	$today = Carbon::today()->startOfDay();
    	$end = Carbon::today()->endOfDay();
		$start_date = $today->copy()->startOfMonth();
		$end_date = $today->copy()->endOfDay();

//		$data['pagi'] = app('App\Http\Controllers\Gizi\DashBoard\ReadController')->getPemesanan($today,$end,1); //pemesanan pagi hari ini
//		$data['siang'] = app('App\Http\Controllers\Gizi\DashBoard\ReadController')->getPemesanan($today,$end,2); //pemesanan siang hari ini
//		$data['sore'] = app('App\Http\Controllers\Gizi\DashBoard\ReadController')->getPemesanan($today,$end,3); //pemesanan sore hari ini
//		$data['belanja'] = app('App\Http\Controllers\Gizi\DashBoard\ReadController')->getTotalBelanja($today,$end);// total belanja hari ini
//        dd($data);
		$data['pemesanan_bulanan'] = app('App\Http\Controllers\Gizi\DashBoard\ReadController')
									->getPemesananBulanan($start_date,$end_date); //total pemesanan bulan ini
		$data['belanja_bulanan'] = app('App\Http\Controllers\Gizi\DashBoard\ReadController')
									->getBelanjaBulanan($start_date,$end_date); // total belanja bulan ini
		//dd($data);		
		$data['status'] = 'home';
		return view('gizi.dashboard.index',$data);
    }
}

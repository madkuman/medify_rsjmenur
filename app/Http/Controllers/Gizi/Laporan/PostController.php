<?php

namespace App\Http\Controllers\Gizi\Laporan;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\Gizi\LaporanRekapBahan;
use Carbon\Carbon;

class PostController extends Controller
{
    public function rekapbahan(Request $request)
    {	
	    //dd($request);
	    $date1 = $request->get('daterange1');
	    $date2 = $request->get('daterange2');
	    $flag = $request->get('flag');

	    if($flag == 0 || empty($flag))
	    {
	    	//dd('masuk');
	    	$data = app('App\Http\Controllers\Gizi\Laporan\ReadController')->getRekapBelanjaBahan($date1,$date2);
	    	//dd($data);	
	    }	    
	    else if($flag == 1)
	    {
	    	$data = app('App\Http\Controllers\Gizi\Laporan\ReadController')->getRekapDinas($date1,$date2);
	    }
	    else if($flag == 2)
	    {
	    	$data = app('App\Http\Controllers\Gizi\Laporan\ReadController')->getRekapHankam($date1,$date2);
	    }
	    else if($flag == 3)
	    {
	    	$data = app('App\Http\Controllers\Gizi\Laporan\ReadController')->getRekapNonHankam($date1,$date2);
	    }
	    else if($flag == 4)
	    {
	    	$data = app('App\Http\Controllers\Gizi\Laporan\ReadController')->getRekapJamkesmas($date1,$date2);
	    }
	    else if($flag == 5)
	    {
	    	$data = app('App\Http\Controllers\Gizi\Laporan\ReadController')->getRekapPC($date1,$date2);
	    }
	    
	    $data['mulai'] = $date1;
	    $data['akhir'] = $date2;
	    //dd($data);
	    //unset($data['mulai'],$data['akhir']); //nanti hapus
	    $date1 = Carbon::parse($date1)->format('d-F-Y');
	    $date2 = Carbon::parse($date2)->format('d-F-Y');
	    //dd($data);
	    return view('gizi.laporan.belanja-bahan',['data'=>$data,'mulai'=>$date1,'akhir'=>$date2,'flag'=>$flag]);
	    //return view('gizi.laporan.belanja-bahan');
	    //return view('gizi.laporan.belanja-bahan',['data'=>$data,'mulai'=>$date1,'akhir'=>$date2]);

	   /* return (new LaporanRekapBahan($data))->download('laporan_rekap_'.$date1.'_'.$date2.'.xlsx');*/
	}
}

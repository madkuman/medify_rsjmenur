<?php

namespace App\Http\Controllers\Gizi\Pengantaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\Pemesanan;
use App\Models\Gizi\PemesananDetail;
use App\Models\RawatInap\Bangsal;
use App\Models\RawatInap\Ruangan;
use Carbon\Carbon;
use DOMPDF;

class ViewController extends Controller
{
    public function index(Request $request)
    {	
    	ini_set('max_execution_time', 300);
    	if(empty($request->get('tanggal')))
    	{	
    		$today_start = Carbon::today()->startOfDay();
    		$today_end = Carbon::today()->endOfDay();
    		//$tomorrow_end = Carbon::parse($start)->addDay()->endOfDay();	
    	}
    	else
    	{
    		$today_start = Carbon::parse($request->get('tanggal'))->startOfDay();
    		$today_end = Carbon::parse($request->get('tanggal'))->endOfDay();
    		//$tomorrow_end = Carbon::parse($request->get('tanggal'))->addDay()->endOfDay();
    	}
        if(empty($request->get('lokasi')))
        {
            $lokasi = 0;
            $data['pagi'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesanan($today_start,$today_end,1);
            $data['siang'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesanan($today_start,$today_end,2);
            $data['sore'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesanan($today_start,$today_end,3);
            $data['s_pagi'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesanan($today_start,$today_end,4);
            $data['s_sore'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesanan($today_start,$today_end,5);    
        }
        else
        {   
            $lokasi = $request->get('lokasi');
            $data['pagi'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesananLokasi($today_start,$today_end,1,$lokasi);
            $data['siang'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesananLokasi($today_start,$today_end,2,$lokasi);
            $data['sore'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesananLokasi($today_start,$today_end,3,$lokasi);
            $data['s_pagi'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesananLokasi($today_start,$today_end,4,$lokasi);
            $data['s_sore'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesananLokasi($today_start,$today_end,5,$lokasi);   
        }
    	
    	$date = Carbon::parse($request->get('tanggal'))->format('d F Y');
        //$data['tanggal'] = $date;
    	$bangsal = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getBangsal();
        $status = 'pengantaran';
        return view('gizi.pengantaran.index',['data'=>$data,'date'=>$date, 'bangsal'=>$bangsal, 'lokasi'=>$lokasi, 'status'=>$status]);
    }

    public function print(Request $request)
    {
        ini_set('max_execution_time', 300);
        if(empty($request->get('tanggal')))
        {   
            $today_start = Carbon::today()->startOfDay();
            $today_end = Carbon::today()->endOfDay();
            //$tomorrow_end = Carbon::parse($start)->addDay()->endOfDay();  
        }
        else
        {   
            $tanggal = $request->get('tanggal');
            $today_start = Carbon::parse($tanggal)->startOfDay();
            $today_end = Carbon::parse($tanggal)->endOfDay();
            //$tomorrow_end = Carbon::parse($request->get('tanggal'))->addDay()->endOfDay();
        }

        // if(empty($request->get('lokasi')))
        // {
        //     $lokasi = 0;
        //     $data['pagi'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesanan($today_start,$today_end,1);
        //     $data['siang'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesanan($today_start,$today_end,2);
        //     $data['sore'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesanan($today_start,$today_end,3);
        //     $data['s_pagi'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesanan($today_start,$today_end,4);
        //     $data['s_sore'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesanan($today_start,$today_end,5);    
        // }
        // else
        // {   
        //     $lokasi = $request->get('lokasi');
        //     $data['pagi'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesananLokasi($today_start,$today_end,1,$lokasi);
        //     $data['siang'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesananLokasi($today_start,$today_end,2,$lokasi);
        //     $data['sore'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesananLokasi($today_start,$today_end,3,$lokasi);
        //     $data['s_pagi'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesananLokasi($today_start,$today_end,4,$lokasi);
        //     $data['s_sore'] = app('App\Http\Controllers\Gizi\Pengantaran\ReadController')->getPemesananLokasi($today_start,$today_end,5,$lokasi);   
        // }

        $pemesanan = [];
        if (empty($request->get('lokasi'))) {
            $lokasi = 0;
            $query = PemesananDetail::with(['pengantar', 'diet'])
                    ->whereBetween('untuk_tanggal', [$today_start, $today_end])
                    ->get()->groupBy('pemesanan_id');
            
        } else {
            $lokasi = $request->get('lokasi');

            $bangsal = Bangsal::where('id', $lokasi)->first();
            $ruangan = Ruangan::where('bangsal_id', $bangsal->id)->pluck('lokasi_id');
            
            $query = PemesananDetail::with(['pengantar', 'diet'])
                    ->whereHas('pemesanan', function ($q) use (&$ruangan){
                        $q->whereIn('lokasi_id', $ruangan);
                    })
                    ->whereBetween('untuk_tanggal', [$today_start,$today_end])
                    ->get()->groupBy('pemesanan_id');;
        }

        foreach($query as $key => $item) {
            $pemesanan_detail = $item->toArray();
            $pemesanan[$key] = Pemesanan::with(['kasus.lokasi.lokasi','pasien'])->find($key)->toArray();
            $pemesanan[$key] = array_merge($pemesanan[$key], ["pemesanan_detail" => $pemesanan_detail]);
        }
        
        $data['pemesanan'] = collect($pemesanan);
        $data['lokasi'] = $lokasi;
        $data['date'] = Carbon::parse($request->get('tanggal'))->format('d F Y');
        $data['status'] = 'pengantaran';

        // return view('gizi.pengantaran.print-pemesanan',['data'=>$data,'date'=>$date, 'lokasi'=>$lokasi, 'status'=>$status]);
        $pdf = DOMPDF::loadView("gizi.pengantaran.print-pemesanan", $data)->setPaper('letter', 'landscape');
        return $pdf->stream("print.pdf");
    } 
}

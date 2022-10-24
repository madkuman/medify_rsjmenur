<?php

namespace App\Http\Controllers\Online\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Online\Transaksi;
use Carbon\Carbon;

class ViewController extends Controller
{
    	public function index(Request $request)
    	{
    		$data['confirmed'] = $request->get("confirmed");
    		$data['waiting'] = $request->get("waiting");
    		$data['expired'] = $request->get("expired");
    		if(empty($data['waiting']) && empty($data['expired']) && empty($data['confirmed']) ) $data['waiting'] = 1;

    		$this->updateTransaksiStatusExpired();
    		$statistik = $this->getStatistik();

    		$status = [];

    		if($data['waiting'] == 1) $status[] = 0;
    		if($data['confirmed'] == 1)  $status[] = 1;
    		if($data['expired'] == 1)  $status[] = -1;


    		$transaksi = Transaksi::whereIn('status',$status)->get();

    		$data['transaksi'] = $transaksi;
    		$data['statistik'] = $statistik;
    		return view('online.transaksi.index',$data);
    	}

    	private function updateTransaksiStatusExpired()
    	{
    		$now = Carbon::now();
    		$transaksi = Transaksi::where('expired_at','<',$now)->where('status',0)->update(['status' => -1]);
    	}

    	private function getStatistik()
    	{
    		$start = Carbon::now()->startOfDay();
    		$end = Carbon::now()->endOfDay();
    		$data['total'] = Transaksi::whereBetween('created_at',[$start,$end])->count();
    		$data['expired'] = Transaksi::whereBetween('created_at',[$start,$end])->where('status',-1)->count();
    		$data['poli'] = Transaksi::whereBetween('created_at',[$start,$end])->where('status',1)->where('tipe_id',1)->count();
    		$data['medcheck'] = Transaksi::whereBetween('created_at',[$start,$end])->where('status',1)->where('tipe_id',2)->count();

    		$obj = (object) $data;
    		return $obj;
    	}
}

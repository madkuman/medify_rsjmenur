<?php

namespace App\Http\Controllers\RawatJalan\PermintaanRujuk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\PermintaanRujuk;

class EditController extends Controller
{
    	public function updateStatus($rujuk_id,$status)
    	{
    		$rujuk = PermintaanRujuk::find($rujuk_id);
    		$rujuk->status = $status;
    		$rujuk->save();
    		return $rujuk;
    	}

    	public function batal(Request $request)
    	{
    		//dd($request);
    		$data = PermintaanRujuk::where('id',$request->transaksi_id)->first();
    		$data->status = -1;
    		$data->alasan = $request->keterangan;
    		$data->save();

    		return back();
    	}
}

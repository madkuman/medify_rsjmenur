<?php

namespace App\Http\Controllers\CSSD\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CSSD\Transaksi;
use Carbon\Carbon;
use Auth;

class EditController extends Controller
{
    	public function editStatus($id,$status,$keterangan_tolak='')
    	{
    		$transaksi = Transaksi::find($id);
    		$transaksi->status = $status;
    		$transaksi->keterangan_tolak = $keterangan_tolak;
    		$transaksi->sent_at = Carbon::now();
    		$transaksi->sent_by = Auth::user()->id;
    		$transaksi->save();

    		return $transaksi;
    	}
}

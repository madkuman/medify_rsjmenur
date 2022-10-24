<?php

namespace App\Http\Controllers\Online\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Online\Transaksi;
use Auth, DB;
use Carbon\Carbon;

class EditController extends Controller
{
    	public function konfirmasi($id)
    	{
    		$transaksi = Transaksi::find($id);
    		$transaksi->status = 1;
    		$transaksi->confirmed_at = Carbon::now();
    		$transaksi->confirmed_by = Auth::user()->id;
    		$transaksi->save();

    		return $transaksi;
    	}
}

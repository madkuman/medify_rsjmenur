<?php

namespace App\Http\Controllers\Kasus\PembayaranTambahan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PembayaranTambahan;
use Auth;

class CreateController extends Controller
{
    	public function create($kasus_id,$pasien_pembayaran_id)
    	{
    		$item = new PembayaranTambahan;
    		$item->kasus_id = $kasus_id;
    		$item->pasien_pembayaran_id = $pasien_pembayaran_id;
    		$item->created_by = Auth::user()->id;
    		$item->save();
    		return $item;
    	}
}

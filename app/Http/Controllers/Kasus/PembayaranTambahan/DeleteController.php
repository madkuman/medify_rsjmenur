<?php

namespace App\Http\Controllers\Kasus\PembayaranTambahan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PembayaranTambahan;

class DeleteController extends Controller
{
    	public function deleteAll($kasus_id)
    	{
    		$items = PembayaranTambahan::where('kasus_id',$kasus_id)->delete();
    		return 1;
    	}
}

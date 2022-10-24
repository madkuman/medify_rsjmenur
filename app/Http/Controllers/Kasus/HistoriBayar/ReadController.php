<?php

namespace App\Http\Controllers\Kasus\HistoriBayar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\DP;
use App\Models\Kasir\Tagihan;

class ReadController extends Controller
{
    public function getHistori($kasus_id)
    {
    	$histori = Tagihan::where('kasus_id',$kasus_id)->orderBY('created_at','desc')->get();
    	return $histori;
    }
}

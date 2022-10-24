<?php

namespace App\Http\Controllers\Kasus\HistoriBayar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\DP;
use Auth;

class CreateController extends Controller
{
    public function create($jumlah,$kasir,$tagihan,$kasus)
    {
    	$dp = new DP;
    	$dp->jumlah = $jumlah;
    	$dp->kasir_id = $kasir;
    	$dp->kasus_id = $kasus;
    	$dp->tagihan_id = $tagihan;
    	$dp->created_by = Auth::user()->id;
    	$dp->save();
    	return $dp;
    }
}

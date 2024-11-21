<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\KFA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\KodeKfaDetail as KodeKfaDetail;

class ViewController extends Controller
{
    public function getDetail($kode_kfa)
    {
        $product = KodeKfaDetail::where('kode_kfa', $kode_kfa)->first();
        // dd($product);
        return $product;
    }
}

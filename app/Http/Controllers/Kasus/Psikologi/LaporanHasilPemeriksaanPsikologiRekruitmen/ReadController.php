<?php

namespace App\Http\Controllers\Kasus\Psikologi\LaporanHasilPemeriksaanPsikologiRekruitmen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\LaporanHasilPemeriksaanPsikologiRekruitmen;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return LaporanHasilPemeriksaanPsikologiRekruitmen::all();
    }
}
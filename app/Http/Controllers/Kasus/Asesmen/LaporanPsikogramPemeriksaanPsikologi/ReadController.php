<?php

namespace App\Http\Controllers\Kasus\Asesmen\LaporanPsikogramPemeriksaanPsikologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\LaporanPsikogramPemeriksaanPsikologi;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return LaporanPsikogramPemeriksaanPsikologi::all();
    }
}
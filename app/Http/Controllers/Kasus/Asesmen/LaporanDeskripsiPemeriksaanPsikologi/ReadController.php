<?php

namespace App\Http\Controllers\Kasus\Asesmen\LaporanDeskripsiPemeriksaanPsikologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\LaporanDeskripsiPemeriksaanPsikologi;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return LaporanDeskripsiPemeriksaanPsikologi::all();
    }
}
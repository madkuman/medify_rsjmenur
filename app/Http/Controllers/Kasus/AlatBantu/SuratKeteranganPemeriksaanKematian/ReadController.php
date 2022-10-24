<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratKeteranganPemeriksaanKematian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratKeteranganPemeriksaanKematian;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return SuratKeteranganPemeriksaanKematian::all();
    }
}
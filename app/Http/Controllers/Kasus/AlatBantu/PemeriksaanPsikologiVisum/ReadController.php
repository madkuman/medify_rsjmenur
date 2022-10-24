<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PemeriksaanPsikologiVisum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PemeriksaanPsikologiVisum;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return PemeriksaanPsikologiVisum::all();
    }
}
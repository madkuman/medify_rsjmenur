<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratPermintaanMasukRumahSakit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratPermintaanMasukRumahSakit;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return SuratPermintaanMasukRumahSakit::all();
    }
}
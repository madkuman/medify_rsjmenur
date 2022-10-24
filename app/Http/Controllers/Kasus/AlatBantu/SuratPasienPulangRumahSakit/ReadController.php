<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratPasienPulangRumahSakit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratPasienPulangRumahSakit;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return SuratPasienPulangRumahSakit::all();
    }
}
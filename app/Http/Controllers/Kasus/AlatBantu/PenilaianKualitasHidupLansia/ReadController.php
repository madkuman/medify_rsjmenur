<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PenilaianKualitasHidupLansia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PenilaianKualitasHidupLansia;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return PenilaianKualitasHidupLansia::all();
    }
}
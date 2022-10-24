<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratPersetujuanDirawat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratPersetujuanDirawat;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return SuratPersetujuanDirawat::all();
    }
}
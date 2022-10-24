<?php

namespace App\Http\Controllers\Kasus\Asesmen\EvaluasiPerencanaanPemulanganPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\EvaluasiPerencanaanPemulanganPasien;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return EvaluasiPerencanaanPemulanganPasien::all();
    }
}
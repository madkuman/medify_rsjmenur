<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenPerencanaanPemulanganPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenPerencanaanPemulanganPasien;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return AsesmenPerencanaanPemulanganPasien::all();
    }
}
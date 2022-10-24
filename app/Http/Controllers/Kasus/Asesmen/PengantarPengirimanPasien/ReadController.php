<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengantarPengirimanPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PengantarPengirimanPasien;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return PengantarPengirimanPasien::all();
    }
}
<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenPendidikanPasienDanKeluarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenPendidikanPasienDanKeluarga;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return AsesmenPendidikanPasienDanKeluarga::all();
    }
}
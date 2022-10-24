<?php

namespace App\Http\Controllers\Kasus\Asesmen\PenandaanAreaOperasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PenandaanAreaOperasi\PenandaanAreaOperasi;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return PenandaanAreaOperasi::all();
    }
}
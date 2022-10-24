<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianPenggunaanAntibiotikProfilaksis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PengkajianPenggunaanAntibiotikProfilaksis;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return PengkajianPenggunaanAntibiotikProfilaksis::all();
    }
}
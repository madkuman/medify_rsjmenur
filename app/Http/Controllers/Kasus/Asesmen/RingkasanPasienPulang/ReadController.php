<?php

namespace App\Http\Controllers\Kasus\Asesmen\RingkasanPasienPulang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\RingkasanPasienPulang;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return RingkasanPasienPulang::all();
    }
}
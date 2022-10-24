<?php

namespace App\Http\Controllers\Kasus\Asesmen\RingkasanPasienMasukDanKeluar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\RingkasanPasienMasukDanKeluar;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return RingkasanPasienMasukDanKeluar::all();
    }
}
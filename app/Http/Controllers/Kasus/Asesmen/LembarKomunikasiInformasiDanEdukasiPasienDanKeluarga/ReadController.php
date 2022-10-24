<?php

namespace App\Http\Controllers\Kasus\Asesmen\LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga::all();
    }
}
<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengantarPengirimanPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PengantarPengirimanPasien;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$pengantar_pengiriman_pasien = new PengantarPengirimanPasien;
    	
        $pengantar_pengiriman_pasien->rumah_sakit_tujuan = $req->rumah_sakit_tujuan;
        $pengantar_pengiriman_pasien->saran_perawatan_dan_pengobatan_lebih_lanjut = $req->saran_perawatan_dan_pengobatan_lebih_lanjut;
    	$pengantar_pengiriman_pasien->created_by = Auth::user()->id;
    	$pengantar_pengiriman_pasien->kasus_id = $kasus_id;
    	$pengantar_pengiriman_pasien->save();
    }
}
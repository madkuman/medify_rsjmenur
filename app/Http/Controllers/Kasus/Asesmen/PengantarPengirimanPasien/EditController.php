<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengantarPengirimanPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PengantarPengirimanPasien;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$pengantar_pengiriman_pasien = PengantarPengirimanPasien::find($req->id);
    	
        $pengantar_pengiriman_pasien->rumah_sakit_tujuan = $req->rumah_sakit_tujuan;
        $pengantar_pengiriman_pasien->saran_perawatan_dan_pengobatan_lebih_lanjut = $req->saran_perawatan_dan_pengobatan_lebih_lanjut;
        $pengantar_pengiriman_pasien->updated_by = Auth::user()->id;
    	$pengantar_pengiriman_pasien->save();
    }
}
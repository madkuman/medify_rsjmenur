<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratPasienPulangRumahSakit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratPasienPulangRumahSakit;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$surat_pasien_pulang_rumah_sakit = SuratPasienPulangRumahSakit::find($req->id);
    	
        $surat_pasien_pulang_rumah_sakit->nama = $req->nama;
        $surat_pasien_pulang_rumah_sakit->alamat = $req->alamat;
        $surat_pasien_pulang_rumah_sakit->telepon = $req->telepon;
        $surat_pasien_pulang_rumah_sakit->hubungan_dengan_pasien = $req->hubungan_dengan_pasien;
        $surat_pasien_pulang_rumah_sakit->pasien_telah_dinyatakan = $req->pasien_telah_dinyatakan;
        $surat_pasien_pulang_rumah_sakit->rujuk_ke = $req->rujuk_ke;
        $surat_pasien_pulang_rumah_sakit->updated_by = Auth::user()->id;
    	$surat_pasien_pulang_rumah_sakit->save();
    }
}
<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResumeGawatDarurat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\ResumeGawatDarurat;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$resume_gawat_darurat = ResumeGawatDarurat::find($req->id);
    	
        $resume_gawat_darurat->pulang = $req->pulang;
        if(!empty($req->kontrol_ulang_tanggal)){        
            $resume_gawat_darurat->kontrol_ulang_tanggal = Carbon::createFromFormat("d/m/Y", $req->kontrol_ulang_tanggal);
        } else {
            $resume_gawat_darurat->kontrol_ulang_tanggal = null;
        }
        $resume_gawat_darurat->kontrol_ulang_di = $req->kontrol_ulang_di;
        $resume_gawat_darurat->pulang_atas_permintaan_keluarga = $req->pulang_atas_permintaan_keluarga;
        $resume_gawat_darurat->observasi = $req->observasi;
        $resume_gawat_darurat->pulang_jam = $req->pulang_jam;
        $resume_gawat_darurat->mrs = $req->mrs;
        $resume_gawat_darurat->alasan_menolak_mrs_masalah_biaya = $req->alasan_menolak_mrs_masalah_biaya;
        $resume_gawat_darurat->alasan_menolak_mrs_masalah_lokasi_rumah = $req->alasan_menolak_mrs_masalah_lokasi_rumah;
        $resume_gawat_darurat->alasan_menolak_mrs_masalah_kondisi_pasien = $req->alasan_menolak_mrs_masalah_kondisi_pasien;
        $resume_gawat_darurat->alasan_menolak_mrs_masalah_kondisi_pasien = $req->alasan_menolak_mrs_masalah_kondisi_pasien;
        $resume_gawat_darurat->alasan_lainnya = $req->alasan_lainnya;
        $resume_gawat_darurat->dirawat_di_ruang = $req->dirawat_di_ruang;
        $resume_gawat_darurat->dirujuk = $req->dirujuk;
        $resume_gawat_darurat->alasan_dirujuk_tempat_penuh = $req->alasan_dirujuk_tempat_penuh;
        $resume_gawat_darurat->alasan_dirujuk_perlu_fasilitas_lebih = $req->alasan_dirujuk_perlu_fasilitas_lebih;
        $resume_gawat_darurat->alasan_dirujuk_permintaan_pasien_dan_keluarga = $req->alasan_dirujuk_permintaan_pasien_dan_keluarga;
        $resume_gawat_darurat->alasan_dirujuk_permintaan_pasien_dan_keluarga = $req->alasan_dirujuk_permintaan_pasien_dan_keluarga;
        $resume_gawat_darurat->alasan_lain = $req->alasan_lain;
        $resume_gawat_darurat->alergi = $req->alergi;
        $resume_gawat_darurat->risiko = $req->risiko;
        $resume_gawat_darurat->updated_by = Auth::user()->id;
    	$resume_gawat_darurat->save();
    }
}
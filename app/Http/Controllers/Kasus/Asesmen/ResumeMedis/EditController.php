<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResumeMedis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\ResumeMedis;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$resume_medis = ResumeMedis::find($req->id);
    	
        $resume_medis->alasan_datang_indikasi_dirawat = $req->alasan_datang_indikasi_dirawat;
        $resume_medis->diagnosa_masuk = $req->diagnosa_masuk;
        $resume_medis->diagnosa_utama = $req->diagnosa_utama;
        $resume_medis->diagnosa_tambahan = $req->diagnosa_tambahan;
        $resume_medis->pemeriksaan_fisik = $req->pemeriksaan_fisik;
        $resume_medis->tindakan_prosedur_utama = $req->tindakan_prosedur_utama;
        $resume_medis->tindakan_prosedur_lain = $req->tindakan_prosedur_lain;
        $resume_medis->terapi_pengobatan_selama_di_rs = $req->terapi_pengobatan_selama_di_rs;
        $resume_medis->terapi_pengobatan_setelah_pulang = $req->terapi_pengobatan_setelah_pulang;
        $resume_medis->instruksi_tindak_lanjut_follow_up = $req->instruksi_tindak_lanjut_follow_up;
        $resume_medis->lanjutan_pengobatan = $req->lanjutan_pengobatan;
        $resume_medis->lanjutan_pengobatan_di = $req->lanjutan_pengobatan_di;
        $resume_medis->keadaan_keluar = $req->keadaan_keluar;
        $resume_medis->rujuk_ke = $req->rujuk_ke;
        $resume_medis->cara_keluar = $req->cara_keluar;
        $resume_medis->alergi_tidak_ada_alergi = $req->alergi_tidak_ada_alergi;
        $resume_medis->alergi_obat_obatan = $req->alergi_obat_obatan;
        $resume_medis->alergi_makanan = $req->alergi_makanan;
        $resume_medis->alergi_lainnya = $req->alergi_lainnya;
        $resume_medis->alergi_lainnya = $req->alergi_lainnya;
        $resume_medis->keterangan_alergi = $req->keterangan_alergi;
        $resume_medis->updated_by = Auth::user()->id;
    	$resume_medis->save();
    }
}
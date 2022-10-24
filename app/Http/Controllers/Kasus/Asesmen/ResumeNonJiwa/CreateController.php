<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResumeNonJiwa;

use App\Models\Kasus\ResumeNonJiwa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$resume_non_jiwa = new ResumeNonJiwa();

        $resume_non_jiwa->diagnosa_masuk = $req->diagnosa_masuk;
        $resume_non_jiwa->diagnosa_utama = $req->diagnosa_utama;
        $resume_non_jiwa->diagnosa_tambahan = $req->diagnosa_tambahan;
        $resume_non_jiwa->jenis_tindakan = $req->jenis_tindakan;
        $resume_non_jiwa->alasan_rawat = $req->alasan_rawat;
        $resume_non_jiwa->ringkasan = $req->ringkasan;
        $resume_non_jiwa->pemeriksaan_fisik = $req->pemeriksaan_fisik;
        $resume_non_jiwa->lab = $req->lab;
        $resume_non_jiwa->terapi = $req->terapi;
        $resume_non_jiwa->hasil_konsul = $req->hasil_konsul;
        $resume_non_jiwa->perkembangan = $req->perkembangan;
        $resume_non_jiwa->keadaan_krs = $req->keadaan_krs;
        $resume_non_jiwa->poli_id = $req->poli_id;
        $resume_non_jiwa->waktu_kontrol = $req->waktu_kontrol;
        $resume_non_jiwa->instruksi = $req->instruksi;
    	$resume_non_jiwa->created_by = Auth::user()->id;
    	$resume_non_jiwa->kasus_id = $kasus_id;
    	$resume_non_jiwa->save();
    }
}
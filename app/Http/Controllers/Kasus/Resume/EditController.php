<?php

namespace App\Http\Controllers\Kasus\Resume;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Resume;
use Auth;
use DB;
use Bugsnag;

class EditController extends Controller
{
  public function edit(Request $request)
    {
      $resume = Resume::find($request->resume_id);
      $resume->diagnosa_masuk = $request->diagnosa_masuk;
      $resume->diagnosa_utama = $request->diagnosa_utama;
      $resume->diagnosa_tambahan = $request->diagnosa_tambahan;
      $resume->tindakan_icd9 = $request->jenis_tindakan;
      $resume->alasan_rawat = $request->alasan_rawat;
      $resume->ringkasan = $request->ringkasan;
      $resume->pemeriksaan_fisik = $request->pemeriksaan_fisik;
      $resume->lab = $request->lab;
      $resume->terapi = $request->terapi;
      $resume->hasil_konsul = $request->hasil_konsul;
      $resume->perkembangan = $request->perkembangan;
      $resume->keadaan_krs = $request->keadaan_krs;
      $resume->waktu_kontrol = $request->waktu_kontrol;
      $resume->instruksi = $request->instruksi;
      $resume->poli_id = $request->poli_id;
      $resume->save();

      return $resume;
    }
}

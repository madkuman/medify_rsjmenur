<?php

namespace App\Http\Controllers\Kasus\Urikkes\EvaluasiKlinis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Bugsnag;
use App\Models\Kasus\EvaluasiKlinis;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Identitas;
class EditController extends Controller
{
    public function index(Request $request, $nomor_kasus){
      $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
      $eval = EvaluasiKlinis::where('id',$request->eval_id)->first();
      $identitas = Identitas::where('kasus_id',$kasus->id)->first();
      // dd($eval, $request->eval_id, $request->kmlkk, $request->ket_kmlkk);
      try {
        DB::connection('kasus')->beginTransaction();
        $identitas->tinggi_badan = $request->input('tinggi-badan');
        $identitas->berat_badan= $request->input('berat-badan');
        $identitas->lingkar_perut = $request->input('lingkar_perut');
        $identitas->tekanan_darah_tensi = $request->input('tekanan_darah_tensi');
        $identitas->bentuk_badan = $request->input('bentuk-badan');
        $identitas->golongan_darah = $request->gol_darah;
        $identitas->nadi = $request->nadi;
        $identitas->riwayat_sakit = $request->riwayat_sakit;
        
        $eval->nomor_kasus = $nomor_kasus;
        $identitas->nadi = $request->input('nadi');
        $eval->created_by = Auth::user()->id;
        $eval->kepala = $request->kepala;
        $eval->ket_kepala = $request->ket_kepala;
        $eval->leher = $request->leher;
        $eval->ket_leher = $request->ket_leher;
        $eval->gondok = $request->gondok;
        $eval->ket_gondok = $request->ket_gondok;
        $eval->hidung = $request->hidung;
        $eval->ket_hidung = $request->ket_hidung;
        $eval->sinus = $request->sinus;
        $eval->ket_sinus = $request->ket_sinus;
        $eval->mulut = $request->mulut;
        $eval->ket_mulut = $request->ket_mulut;
        $eval->lidah = $request->lidah;
        $eval->ket_lidah = $request->ket_lidah;
        $eval->tenggorokan = $request->tenggorokan;
        $eval->ket_tenggorokan = $request->ket_tenggorokan;
        $eval->tonsil = $request->tonsil;
        $eval->ket_tonsil = $request->ket_tonsil;
        $eval->telinga = $request->telinga;
        $eval->ket_telinga = $request->ket_telinga;
        $eval->membran_tympani = $request->membran_tympani;
        $eval->ket_membran_tympani = $request->ket_membran_tympani;
        $eval->mata = $request->mata;
        $eval->ket_mata = $request->ket_mata;
        $eval->ophtalmoscopy = $request->ophtalmoscopy;
        $eval->ket_ophtalmoscopy = $request->ket_ophtalmoscopy;
        $eval->pupil = $request->pupil;
        $eval->ket_pupil = $request->ket_pupil;
        $eval->gerakan_mata = $request->gerakan_mata;
        $eval->ket_ger_mat = $request->ket_gerakan_mata;
        $eval->dada_paru = $request->dada_paru;
        $eval->ket_dada_paru = $request->ket_dada_paru;
        $eval->jantung = $request->jantung;
        $eval->ket_jantung = $request->ket_jantung;
        $eval->abdomen_viscera = $request->abdomen_viscera;
        $eval->ket_abdomen_viscera = $request->ket_abdomen_viscera;
        $eval->arf = $request->arf;
        $eval->ket_arf = $request->ket_arf;
        $eval->endokrin = $request->endokrin;
        $eval->ket_endokrin = $request->ket_endokrin;
        $eval->genito_urin = $request->genito_urin;
        $eval->ket_genito_urinaria = $request->ket_genito_urinaria;
        $eval->extrimitas_bwh = $request->extrimitas_bwh;
        $eval->ket_extrim_bwh = $request->ket_extrimitas_bwh;
        $eval->extrimitas_atas = $request->extrimitas_atas;
        $eval->ket_extrim_atas = $request->ket_extrimitas_atas;
        $eval->kaki = $request->kaki;
        $eval->ket_kaki = $request->ket_kaki;
        $eval->telapak_kaki = $request->telapak_kaki;
        $eval->ket_telapak_kaki = $request->ket_telapak_kaki;
        $eval->kulit = $request->kulit;
        $eval->ket_kulit = $request->ket_kulit;
        $eval->col_vp = $request->col_vp;
        $eval->ket_col_vp = $request->ket_col_vp;
        $eval->neurologi = $request->neurologi;
        $eval->spirometry = $request->spirometry;
        $eval->ecg =$request->ecg;
        $eval->ro_thorax = $request->ro_thorax;
        $eval->mamae = $request->mamae;
        $eval->hati = $request->hati;
        $eval->limpa = $request->limpa;
        $eval->treadmill = $request->treadmill;
        $eval->abdomen = $request->abdomen;
        //$eval->anamnesa = $request->anamnesa;
        $eval->tujuan_pemeriksaan = $request->tujuan_pemeriksaan;
        $eval->tinggi_badan = $request->input('tinggi-badan');
        $eval->berat_badan = $request->input('berat-badan');
        $eval->lingkar_perut = $request->input('lingkar_perut');
        $eval->tekanan_darah = $request->input('tekanan_darah_tensi');
        $eval->nadi = $request->nadi;
        $eval->riwayat_sakit = $request->riwayat_sakit;
        $eval->gol_darah = $request->gol_darah;
        $eval->thorax = $request->thorax;
        $eval->ket_thorax = $request->ket_thorax;
        $eval->mammae = $request->mammae;
        $eval->ket_mammae = $request->ket_mammae;
        $eval->perut = $request->perut;
        $eval->ket_perut = $request->ket_perut;
        $eval->ket_hati = $request->ket_hati;
        $eval->ket_limpa = $request->ket_limpa;
        $eval->hernia = $request->hernia;
        $eval->ket_hernia = $request->ket_hernia;
        $eval->x_ray = $request->x_ray;
        $eval->pap_smear = $request->pap_smear;
        
        $identitas->save();
        $eval->save();
        app('App\Http\Controllers\Kasus\Urikkes\Mata\EditController')->mata($request,$nomor_kasus,$eval->id);
        app('App\Http\Controllers\Kasus\Urikkes\Telinga\EditController')->update($request,$nomor_kasus,$eval);

        DB::connection('kasus')->commit();
        $status = 1;
        $message = 'Evaluasi berhasil diubah!';
        $title = 'Berhasil!';

        return redirect('/kasus/'.$nomor_kasus.'/urikkes#evaluasi')
            ->with('active_nav','evaluasi')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
      } catch (\Exception $e) {
        DB::connection('kasus')->rollback();
        app('App\Http\Controllers\Error\Handler')->bugsnag($e);
      }
    }
}

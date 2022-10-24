<?php

namespace App\Http\Controllers\Kasus\Urikkes\Telinga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;
use Illuminate\Support\Facades\Auth;
use App\Models\Kasus\Telinga;

class CreateController extends Controller
{
    public function index(Request $request, $nomor_kasus){
      //dd($request->input());
      $new = new Telinga();
      foreach($request->input() as $key => $newval){
        if($newval == NULL) {
          $request[$key] = 'Normal';
        }
      }
      //dd($request->input());
      try {
        DB::connection('kasus')->beginTransaction();
        $new->nomor_kasus = $nomor_kasus;
        $new->created_by = Auth::user()->id;
        $new->audio_ad = $request->audio_ad;
        $new->audio_as = $request->audio_as;
        $new->suara_ad = $request->suara_ad;
        $new->suara_as = $request->suara_as;
        $new->liang = $request->liang;
        $new->tajam_pendengaran = $request->tajam_pendengaran;
        $new->gendang_kanan = $request->gendang_kanan;
        $new->gendang_kiri = $request->gendang_kiri;
        $new->save();
        DB::connection('kasus')->commit();
        $status = 1;
        $message = 'Evaluasi telinga berhasil dibuat!';
        $title = 'Berhasil!';

        return redirect('/kasus/'.$nomor_kasus.'/urikkes#telinga')
            ->with('active_nav','telinga')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
      } catch (\Exception $e) {
        DB::connection('kasus')->rollback();
        app('App\Http\Controllers\Error\Handler')->bugsnag($e);
      }
    }

    public function create($request, $nomor_kasus, $fisik_id){
      $new = new Telinga();
      foreach($request->input() as $key => $newval){
        if($newval == NULL) {
          $request[$key] = 'Normal';
        }
      }
      $new->urikkes_fisik_id = $fisik_id;
      $new->nomor_kasus = $nomor_kasus;
      $new->created_by = Auth::user()->id;
      $new->audio_ad = $request->audio_ad;
      $new->audio_as = $request->audio_as;
      $new->suara_ad = $request->suara_ad;
      $new->suara_as = $request->suara_as;
      $new->liang = $request->liang;
      $new->tajam_pendengaran = $request->tajam_pendengaran;
      $new->gendang_kanan = $request->gendang_kanan;
      $new->gendang_kiri = $request->gendang_kiri;
      $new->save();
    }
}

<?php

namespace App\Http\Controllers\Kasus\Urikkes\Telinga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;
use Illuminate\Support\Facades\Auth;
use App\Models\Kasus\Telinga;

class EditController extends Controller
{
    public function index(Request $request, $nomor_kasus){
      $check = Telinga::where('id',$request->id)->first();
      try {
        DB::connection('kasus')->beginTransaction();
        $check->created_by = Auth::user()->id;
        $check->audio_ad = $request->audio_ad;
        $check->audio_as = $request->audio_as;
        $check->suara_ad = $request->suara_ad;
        $check->suara_as = $request->suara_as;
        $check->liang = $request->liang;
        $check->tajam_pendengaran = $request->tajam_pendengaran;
        $check->gendang_kanan = $request->gendang_kanan;
        $check->gendang_kiri = $request->gendang_kiri;
        $check->save();
        DB::connection('kasus')->commit();
        $status = 1;
        $message = 'Evaluasi telinga berhasil diubah!';
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

    public function update($request, $nomor_kasus, $eval){
        if(is_null($eval->telinga_cek))
        {
            $check = new Telinga();
            $check->urikkes_fisik_id = $eval->id;
            $check->nomor_kasus = $nomor_kasus;
        }
        else
        {
            $check = Telinga::find($eval->telinga_cek->id);
        }
            
        foreach($request->input() as $key => $newval){
            if($newval == NULL) {
              $request[$key] = 'Normal';
            }
        }

        $check->created_by = Auth::user()->id;
        $check->audio_ad = $request->audio_ad;
        $check->audio_as = $request->audio_as;
        $check->suara_ad = $request->suara_ad;
        $check->suara_as = $request->suara_as;
        $check->liang = $request->liang;
        $check->tajam_pendengaran = $request->tajam_pendengaran;
        $check->gendang_kanan = $request->gendang_kanan;
        $check->gendang_kiri = $request->gendang_kiri;
        $check->save();
    }
}
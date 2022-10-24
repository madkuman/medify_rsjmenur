<?php

namespace App\Http\Controllers\Kasus\Urikkes\Mata;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;
use Illuminate\Support\Facades\Auth;
use App\Models\Kasus\Mata;

class CreateController extends Controller
{
    public function index(Request $request,$nomor_kasus){
      // dd($request->input());
      $new = new Mata();
      foreach($request->input() as $key => $newval){
        if($newval == NULL) {
          $request[$key] = 'Normal';
        }
      }
      try {
        DB::connection('kasus')->beginTransaction();
        $new->nomor_kasus = $nomor_kasus;
        $new->created_by = Auth::user()->id;
        $new->od = $request->od;
        $new->os = $request->os;
        $new->ket_od = $request->ket_od;
        $new->ket_os = $request->ket_os;
        $new->visus_od = $request->visus_od;
        $new->visus_os = $request->visus_os;
        $new->koreksi_od = $request->koreksi_od;
        $new->koreksi_os = $request->koreksi_os;
        $new->add = $request->add;
        $new->visus_ods = $request->visus_ods;
        $new->bentuk_pupil = $request->bentuk_pupil;
        $new->membedakan_warna = $request->membedakan_warna;
        $new->pemeriksaan_perimetris = $request->pemeriksaan_perimetris;
        $new->tekanan_intraokulair = $request->tekanan_intraokulair;
        $new->save();
        DB::connection('kasus')->commit();
        $status = 1;
        $message = 'Evaluasi mata berhasil dibuat!';
        $title = 'Berhasil!';

        return redirect('/kasus/'.$nomor_kasus.'/urikkes#mata')
            ->with('active_nav','mata')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
      } catch (\Exception $e) {
        DB::connection('kasus')->rollback();
        app('App\Http\Controllers\Error\Handler')->bugsnag($e);
      }
    }
    public function mata(Request $request,$nomor_kasus,$eval_id)
    {

        $new = new Mata();
        // foreach($request->input() as $key => $newval){
        // if($newval == NULL) {
        //   $request[$key] = 'Normal';
        //     }
        // }
        $new->nomor_kasus = $nomor_kasus;
        $new->created_by = Auth::user()->id;
        $new->od = $request->od;
        $new->os = $request->os;
        $new->ket_od = $request->ket_od;
        $new->ket_os = $request->ket_os;
        $new->visus_od = $request->visus_od;
        $new->visus_os = $request->visus_os;
        $new->koreksi_od = $request->koreksi_od;
        $new->koreksi_os = $request->koreksi_os;
        $new->add = $request->add;
        $new->visus_ods = $request->visus_ods;
        $new->bentuk_pupil = $request->bentuk_pupil;
        $new->membedakan_warna = $request->membedakan_warna;
        $new->pemeriksaan_perimetris = $request->pemeriksaan_perimetris;
        $new->tekanan_intraokulair = $request->tekanan_intraokulair;
        $new->urikkes_fisik_id = $eval_id;
        $new->save();
        //dd($new);
        return;
    }
}

<?php

namespace App\Http\Controllers\Kasus\Urikkes\Mata;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;
use Illuminate\Support\Facades\Auth;
use App\Models\Kasus\Mata;

class EditController extends Controller
{
    public function index(Request $request, $nomor_kasus){
      $check = Mata::where('id',$request->id)->first();
      try {
        DB::connection('kasus')->beginTransaction();
        $check->created_by = Auth::user()->id;
        $check->od = $request->od;
        $check->os = $request->os;
        $check->ket_od = $request->ket_od;
        $check->ket_os = $request->ket_os;
        $check->visus_od = $request->visus_od;
        $check->visus_os = $request->visus_os;
        $check->koreksi_od = $request->koreksi_od;
        $check->koreksi_os = $request->koreksi_os;
        $check->add = $request->add;
        $check->visus_ods = $request->visus_ods;
        $check->bentuk_pupil = $request->bentuk_pupil;
        $check->membedakan_warna = $request->membedakan_warna;
        $check->pemeriksaan_perimetris = $request->pemeriksaan_perimetris;
        $check->tekanan_intraokulair = $request->tekanan_intraokulair;
        $check->save();
        DB::connection('kasus')->commit();
        $status = 1;
        $message = 'Evaluasi mata berhasil diubah!';
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
        $check = Mata::where('urikkes_fisik_id',$eval_id)->first();
        foreach($request->input() as $key => $newval){
        if($newval == NULL) {
          $request[$key] = 'Normal';
            }
        }
        $check->nomor_kasus = $nomor_kasus;
        $check->created_by = Auth::user()->id;
        $check->od = $request->od;
        $check->os = $request->os;
        $check->ket_od = $request->ket_od;
        $check->ket_os = $request->ket_os;
        $check->visus_od = $request->visus_od;
        $check->visus_os = $request->visus_os;
        $check->koreksi_od = $request->koreksi_od;
        $check->koreksi_os = $request->koreksi_os;
        $check->add = $request->add;
        $check->visus_ods = $request->visus_ods;
        $check->bentuk_pupil = $request->bentuk_pupil;
        $check->membedakan_warna = $request->membedakan_warna;
        $check->pemeriksaan_perimetris = $request->pemeriksaan_perimetris;
        $check->tekanan_intraokulair = $request->tekanan_intraokulair;
        $check->urikkes_fisik_id = $eval_id;
        $check->save();
        //dd($check);
        return;
    }
}

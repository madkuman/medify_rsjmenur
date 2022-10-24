<?php

namespace App\Http\Controllers\Kasus\Urikkes\Gigi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Gigi;
use App\Models\Kasus\Kasus;
use App\User;
use DB;
use Bugsnag;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function index(Request $request,$nomor_kasus){
      $new = new Gigi();
      foreach($request->input() as $key => $newval){
        if($newval == NULL) {
          $request[$key] = '-';
        }
      }
      try {
        DB::connection('kasus')->beginTransaction();
        $new->nomor_kasus = $nomor_kasus;
        $new->created_by = Auth::user()->id;
        $new->dmf = $request->dmf;
        $new->jml_gigi_vital = $request->jml_gigi_vital;
        $new->jml_titik = $request->jml_titik;
        $new->kelainan_gigi = $request->kelainan_gigi;
        $new->kelainan_mulut = $request->kelainan_mulut;
        $new->kelainan_rahang = $request->kelainan_rahang;
        $new->kebersihan_mulut = $request->kebersihan_mulut;
        $new->save();
        DB::connection('kasus')->commit();
        $status = 1;
        $message = 'Pemeriksaan gigi baru berhasil dibuat!';
        $title = 'Berhasil!';

        return redirect('/kasus/'.$nomor_kasus.'/urikkes#gigi')
            ->with('active_nav','gigi')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
      } catch (\Exception $e) {
        DB::connection('kasus')->rollback();
        app('App\Http\Controllers\Error\Handler')->bugsnag($e);
      }     
    }
}

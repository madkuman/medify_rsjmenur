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

class EditController extends Controller
{
    public function index(Request $request, $nomor_kasus){
      $check = Gigi::where('id',$request->id)->first();
      foreach($request->input() as $key => $newval){
        if($newval == NULL) {
          $request[$key] = '-';
        }
      }
      try {
        DB::connection('kasus')->beginTransaction();
        $check->nomor_kasus = $nomor_kasus;
        $check->created_by = Auth::user()->id;
        $check->dmf = $request->dmf;
        $check->jml_gigi_vital = $request->jml_gigi_vital;
        $check->jml_titik = $request->jml_titik;
        $check->kelainan_gigi = $request->kelainan_gigi;
        $check->kelainan_mulut = $request->kelainan_mulut;
        $check->kelainan_rahang = $request->kelainan_rahang;
        $check->kebersihan_mulut = $request->kebersihan_mulut;
        $check->save();
        DB::connection('kasus')->commit();
        $status = 1;
        $message = 'Pemeriksaan gigi berhasil diubah!';
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

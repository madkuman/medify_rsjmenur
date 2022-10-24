<?php

namespace App\Http\Controllers\Kasus\Urikkes\PemeriksaanUmum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Bugsnag;
use App\Models\Kasus\PemeriksaanAwal;
use App\User;

class CreateController extends Controller
{
    public function index(Request $request, $nomor_kasus){
      //dd($request->identitas_id);
      $check = new PemeriksaanAwal();
      try {
        DB::connection('kasus')->beginTransaction();
        $check->nomor_kasus = $nomor_kasus;
        $check->created_by = Auth::user()->id;
        $check->anamnesa = $request->anamnesa;
        $check->tujuan_pemeriksaan = $request->tujuan_pemeriksaan;
        $check->keluhan_utama = $request->keluhan_utama;
        $check->pasien_id = $request->identitas_id;
        $check->save();
        DB::connection('kasus')->commit();
      } catch (\Exception $e) {
        DB::connection('kasus')->rollback();
        app('App\Http\Controllers\Error\Handler')->bugsnag($e);
      }
      return back();

    }
}

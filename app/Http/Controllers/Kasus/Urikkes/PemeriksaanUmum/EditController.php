<?php

namespace App\Http\Controllers\Kasus\Urikkes\PemeriksaanUmum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Bugsnag;
use App\Models\Kasus\PemeriksaanAwal;

class EditController extends Controller
{
    public function index(Request $request, $nomor_kasus){
      try {
        DB::connection('kasus')->beginTransaction();
        $check = PemeriksaanAwal::where('id',$request->id_pemeriksaan)
                ->update([
                  'created_by' => Auth::user()->id,
                  'anamnesa' => $request->anamnesa,
                  'tujuan_pemeriksaan' => $request->tujuan_pemeriksaan,
                  'keluhan_utama' => $request->keluhan_utama
                ]);
        DB::connection('kasus')->commit();
      } catch (\Exception $e) {
        DB::connection('kasus')->rollback();
        app('App\Http\Controllers\Error\Handler')->bugsnag($e);
      }
      return back();
    }
}

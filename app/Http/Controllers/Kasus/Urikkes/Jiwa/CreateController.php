<?php

namespace App\Http\Controllers\Kasus\Urikkes\Jiwa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Jiwa;
use Illuminate\Support\Facades\Auth;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    public function index(Request $request, $nomor_kasus){
      // dd($request->input());
      $jiwa = new Jiwa();
      try {
          DB::connection('kasus')->beginTransaction();
          $jiwa->nomor_kasus = $nomor_kasus;
          $jiwa->created_by = Auth::user()->id;
          $jiwa->hasil_bacaan = $request->hasil_bacaan;
          $jiwa->save();
          DB::connection('kasus')->commit();
      } catch (\Exception $e) {
        DB::connection('kasus')->rollback();
        app('App\Http\Controllers\Error\Handler')->bugsnag($e);
      }
      return back();
    }
}

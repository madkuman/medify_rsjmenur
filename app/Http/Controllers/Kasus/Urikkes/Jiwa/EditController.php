<?php

namespace App\Http\Controllers\Kasus\Urikkes\Jiwa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Jiwa;
use Illuminate\Support\Facades\Auth;
use DB;
use Bugsnag;

class EditController extends Controller
{
    public function index(Request $request, $nomor_kasus){
      $jiwa = Jiwa::where('id',$request->id)->first();
      try {
        DB::connection('kasus')->beginTransaction();
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

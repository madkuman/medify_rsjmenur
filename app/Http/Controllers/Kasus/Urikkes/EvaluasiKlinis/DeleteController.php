<?php

namespace App\Http\Controllers\Kasus\Urikkes\EvaluasiKlinis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;
use App\Models\Kasus\EvaluasiKlinis;

class DeleteController extends Controller
{
    public function index(Request $request, $nomor_kasus){
      try {
        DB::connection('kasus')->beginTransaction();

        $check = EvaluasiKlinis::find($request->id)->delete();
        
        app('App\Http\Controllers\Kasus\Urikkes\Mata\DeleteController')->delete($request,$nomor_kasus);
        app('App\Http\Controllers\Kasus\Urikkes\Telinga\DeleteController')->delete($request,$nomor_kasus);
        DB::connection('kasus')->commit();

        $status = 1;
        $message = 'Evaluasi berhasil dihapus!';
        $title = 'Berhasil!';

        return redirect('/kasus/'.$nomor_kasus.'/urikkes#evaluasi')
            ->with('active_nav','evaluasi')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
      } catch (\Exception $e) {
        DB::connection('kasus')->rollback();
        app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        //dd($e);
      }
    }
}

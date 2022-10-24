<?php

namespace App\Http\Controllers\Kasus\Urikkes\Mata;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;
use Illuminate\Support\Facades\Auth;
use App\Models\Kasus\Mata;

class DeleteController extends Controller
{
    public function index(Request $request,$nomor_kasus){
      $check = Mata::where('id',$request->id)->first();
      try {
        DB::connection('kasus')->beginTransaction();
        $check->delete();
        DB::connection('kasus')->commit();
        $status = 1;
        $message = 'Evaluasi mata berhasil dihapus!';
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

  public function delete(Request $request, $nomor_kasus)
  {
    $check = Mata::where('urikkes_fisik_id',$request->id)->first();
    $check->delete();
    return;
  }
}

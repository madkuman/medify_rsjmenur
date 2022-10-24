<?php

namespace App\Http\Controllers\Kasus\Urikkes\Telinga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;
use Illuminate\Support\Facades\Auth;
use App\Models\Kasus\Telinga;

class DeleteController extends Controller
{
    public function index(Request $request,$nomor_kasus){
      $check = Telinga::where('id',$request->id)->first();
      try {
        DB::connection('kasus')->beginTransaction();
        $check->delete();
        DB::connection('kasus')->commit();
        $status = 1;
        $message = 'Evaluasi telinga berhasil dihapus!';
        $title = 'Berhasil!';

        return redirect('/kasus/'.$nomor_kasus.'/urikkes#telinga')
            ->with('active_nav','telinga')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
      } catch (\Exception $e) {
        DB::connection('kasus')->rollback();
        app('App\Http\Controllers\Error\Handler')->bugsnag($e);
      }
    }

  public function delete($request,$nomor_kasus){
    $check = Telinga::where('urikkes_fisik_id',$request->id)->first();
    if(!is_null($check))
      $check->delete();
  }
}
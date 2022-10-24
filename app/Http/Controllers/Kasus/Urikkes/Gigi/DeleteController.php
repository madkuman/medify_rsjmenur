<?php

namespace App\Http\Controllers\Kasus\Urikkes\Gigi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Gigi;
use App\Models\Kasus\Kasus;
use App\User;
use DB;
use Bugsnag;

class DeleteController extends Controller
{
    public function index(Request $request,$nomor_kasus){
      $check = Gigi::where('id',$request->id)->first();
      try {
        DB::connection('kasus')->beginTransaction();
        $check->delete();
        DB::connection('kasus')->commit();
        $status = 1;
        $message = 'Pemeriksaan gigi berhasil dihapus!';
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

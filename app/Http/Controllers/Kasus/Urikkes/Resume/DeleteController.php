<?php

namespace App\Http\Controllers\Kasus\Urikkes\Resume;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Kasus\Lain_Urikkes;
use DB;
use Bugsnag;

class DeleteController extends Controller
{
  public function index(Request $request, $nomor_kasus){
    $check = Lain_Urikkes::where('id',$request->id)->first();
    try {
      DB::connection('kasus')->beginTransaction();
      $check->delete();
      DB::connection('kasus')->commit();
      $status = 1;
        $message = 'Resume Urikkes berhasil dihapus!';
        $title = 'Berhasil!';

        return redirect('/kasus/'.$nomor_kasus.'/urikkes#resume')
            ->with('active_nav','resume')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
    } catch (\Exception $e) {
      DB::connection('kasus')->rollback();
      app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    }
  }
}

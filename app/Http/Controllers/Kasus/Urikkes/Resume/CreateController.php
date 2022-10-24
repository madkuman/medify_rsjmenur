<?php

namespace App\Http\Controllers\Kasus\Urikkes\Resume;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Kasus\Lain_Urikkes;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    public function index(Request $request,$nomor_kasus){
      // dd($request->input());
      $new = new Lain_Urikkes();
      try {
        DB::connection('kasus')->beginTransaction();
        $new->nomor_kasus = $nomor_kasus;
        $new->resume = $request->resume;
        $new->jiwa = $request->jiwa;
        $new->created_by = Auth::user()->id;
        $new->kualifikasi = $request->kualifikasi;
        $new->saran = $request->saran;
        $new->u = $request->u;
        $new->a = $request->a;
        $new->b = $request->b;
        $new->d = $request->d;
        $new->l = $request->l;
        $new->g = $request->g;
        $new->j = $request->j;
        $new->stakes = $request->stakes;
        $new->catatan_lab = $request->catatan_lab;
        $new->save();
        DB::connection('kasus')->commit();
        $status = 1;
        $message = 'Resume Urikkes berhasil dibuat!';
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

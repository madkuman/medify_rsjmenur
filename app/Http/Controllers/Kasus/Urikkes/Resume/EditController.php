<?php

namespace App\Http\Controllers\Kasus\Urikkes\Resume;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Kasus\Lain_Urikkes;
use DB;
use Bugsnag;

class EditController extends Controller
{
    public function index(Request $request,$nomor_kasus){
      //dd($request->input());
      $update = Lain_Urikkes::where('id',$request->id)->first();
      try {
        DB::connection('kasus')->beginTransaction();
        $update->jiwa = $request->jiwa;
        $update->resume = $request->resume;
        $update->created_by = Auth::user()->id;
        $update->kualifikasi = $request->kualifikasi;
        $update->saran = $request->saran;
        $update->u = $request->u;
        $update->a = $request->a;
        $update->b = $request->b;
        $update->d = $request->d;
        $update->l = $request->l;
        $update->g = $request->g;
        $update->j = $request->j;
        $update->stakes = $request->stakes;
        $update->catatan_lab = $request->catatan_lab;
        $update->save();
        DB::connection('kasus')->commit();
        $status = 1;
        $message = 'Resume Urikkes berhasil diubah!';
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

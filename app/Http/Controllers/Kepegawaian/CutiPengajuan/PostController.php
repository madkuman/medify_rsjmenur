<?php

namespace App\Http\Controllers\Kepegawaian\CutiPengajuan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
    public function formSubmit(Request $request) {
        DB::connection('kepegawaian')->beginTransaction();
        try{
            if($request->id == 0)
                $result = app('App\Http\Controllers\Kepegawaian\CutiPengajuan\CreateController')->create($request);
            else
                $result = app('App\Http\Controllers\Kepegawaian\CutiPengajuan\EditController')->edit($request);

            DB::connection('kepegawaian')->commit();

            $status = $result['status'];
            $message = $result['message'];
            $title = $result['title'];

            return redirect('cuti/pengajuan/form/'.$result['data']->id)
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
            DB::connection('kepegawaian')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = 'Terjadi kesalahan! Silahkan coba lagi';
            $title = 'Gagal!';
        }
        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }

     public function formDelete($data_id) {
        DB::connection('kepegawaian')->beginTransaction();
        try{
            $result = app('App\Http\Controllers\Kepegawaian\CutiPengajuan\DeleteController')->delete($data_id);
            DB::connection('kepegawaian')->commit();

            $status = $result['status'];
            $message = $result['message'];
            $title = $result['title'];
        } catch (\Exception $e) {
            DB::connection('kepegawaian')->rollback();
            $status = -1;
            $message = 'Terjadi kesalahan! Silahkan coba lagi';
            $title = 'Gagal!';
        }
        return redirect('cuti')
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }

    public function formResponse(Request $request){
        DB::connection('kepegawaian')->beginTransaction();
        try{
            $result = app('App\Http\Controllers\Kepegawaian\CutiPengajuan\EditController')->response($request);
            $kuota = app('App\Http\Controllers\Kepegawaian\CutiKuota\DeleteController')->deleteResponse($request->id);
            if($request->status_pengajuan == 1)
            $kuota = app('App\Http\Controllers\Kepegawaian\CutiKuota\CreateController')->createResponse($request->id);

            DB::connection('kepegawaian')->commit();

            $status = $result['status'];
            $message = $result['message'];
            $title = $result['title'];

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
            DB::connection('kepegawaian')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = 'Terjadi kesalahan! Silahkan coba lagi';
            $title = 'Gagal!';
        }
        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }
}

<?php

namespace App\Http\Controllers\Kepegawaian\CutiKuota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
    public function formSubmit(Request $request) {
        DB::connection('kepegawaian')->beginTransaction();
        try{
            if($request->id == 0)
                $result = app('App\Http\Controllers\Kepegawaian\CutiKuota\CreateController')->create($request);
            else
                $result = app('App\Http\Controllers\Kepegawaian\CutiKuota\EditController')->edit($request);

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
    public function formDelete(Request $request) {
        DB::connection('kepegawaian')->beginTransaction();
        try{
            $result = app('App\Http\Controllers\Kepegawaian\CutiKuota\DeleteController')->delete($request->id);
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
        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }
}

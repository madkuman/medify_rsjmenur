<?php

namespace App\Http\Controllers\Kepegawaian\MasterKategoriPegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
    public function create(Request $request)
    {
        DB::connection('kepegawaian')->beginTransaction();
        try
        {
            app('App\Http\Controllers\Kepegawaian\MasterKategoriPegawai\CreateController')->create($request);

            $status = 1;
            $message = 'Input Berhasil';
            $title = 'Berhasil!';

            DB::connection('kepegawaian')->commit();

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kepegawaian')->rollback();

            $status = -1;
            $message = 'Error Exception';
            $title = 'Gagal!';
        }

        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
    }

    public function edit(Request $request, $id)
    {
        DB::connection('kepegawaian')->beginTransaction();
        try
        {
            app('App\Http\Controllers\Kepegawaian\MasterKategoriPegawai\EditController')->edit($request, $id);

            $status = 1;
            $message = 'Update Berhasil';
            $title = 'Berhasil!';

            DB::connection('kepegawaian')->commit();

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kepegawaian')->rollback();

            $status = -1;
            $message = 'Error Exception';
            $title = 'Gagal!';
        }
        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
    }
    public function delete($id)
    {
        DB::connection('kepegawaian')->beginTransaction();
        try
        {
            app('App\Http\Controllers\Kepegawaian\MasterKategoriPegawai\DeleteController')->delete($id);

            $status = 1;
            $message = 'Delete Berhasil';
            $title = 'Berhasil!';

            DB::connection('kepegawaian')->commit();

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kepegawaian')->rollback();

            $status = -1;
            $message = 'Error Exception';
            $title = 'Gagal!';
        }

        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
    }
}

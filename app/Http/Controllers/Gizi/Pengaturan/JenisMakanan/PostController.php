<?php

namespace App\Http\Controllers\Gizi\Pengaturan\JenisMakanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
    public function create(Request $request)
    {
        DB::connection('gizi')->beginTransaction();
        try
        {
            app('App\Http\Controllers\Gizi\Pengaturan\JenisMakanan\CreateController')->create($request);

            $status = 1;
            $message = 'Input Berhasil';
            $title = 'Berhasil!';

            DB::connection('gizi')->commit();

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('gizi')->rollback();

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
        DB::connection('gizi')->beginTransaction();
        try
        {
            app('App\Http\Controllers\Gizi\Pengaturan\JenisMakanan\EditController')->edit($request, $id);

            $status = 1;
            $message = 'Update Berhasil';
            $title = 'Berhasil!';

            DB::connection('gizi')->commit();

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('gizi')->rollback();

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
        DB::connection('gizi')->beginTransaction();
        try
        {
            app('App\Http\Controllers\Gizi\Pengaturan\JenisMakanan\DeleteController')->delete($id);

            $status = 1;
            $message = 'Delete Berhasil';
            $title = 'Berhasil!';

            DB::connection('gizi')->commit();

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('gizi')->rollback();

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

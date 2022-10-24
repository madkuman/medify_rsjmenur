<?php

namespace App\Http\Controllers\Eusulan\Usulan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
    public function create(Request $request)
    {
        try{

            DB::connection('eusulan')->beginTransaction();
            app('App\Http\Controllers\Eusulan\Usulan\CreateController')->create($request);
            DB::connection('eusulan')->commit();
            return redirect('e-usulan')
                ->with('status', 1)
                ->with('message', 'Usulan baru berhasil dibuat')
                ->with('title', 'Sukses');

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('eusulan')->rollBack();
            return redirect()->back()
                ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                ->with('status', -1)
                ->with('title', 'Gagal');
        }
    }

    public function edit($id,Request $request)
    {
        try{

            DB::connection('eusulan')->beginTransaction();
            app('App\Http\Controllers\Eusulan\Usulan\EditController')->edit($id,$request);
            DB::connection('eusulan')->commit();
            return redirect('e-usulan/'.$id)
                ->with('status', 1)
                ->with('message', 'Usulan berhasil diubah')
                ->with('title', 'Sukses');

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('eusulan')->rollBack();
            return redirect()->back()
                ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                ->with('status', -1)
                ->with('title', 'Gagal');
        }
    }

    public function delete($id,Request $request)
    {
        try{

            DB::connection('eusulan')->beginTransaction();
            app('App\Http\Controllers\Eusulan\Usulan\DeleteController')->delete($id);
            DB::connection('eusulan')->commit();
            return redirect('e-usulan')
                ->with('status', 1)
                ->with('message', 'Usulan berhasil dihapus')
                ->with('title', 'Sukses');

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('eusulan')->rollBack();
            return redirect()->back()
                ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                ->with('status', -1)
                ->with('title', 'Gagal');
        }
    }

    public function legalitasAtasan($id,Request $request)
    {
        try{

            DB::connection('eusulan')->beginTransaction();
            app('App\Http\Controllers\Eusulan\Usulan\EditController')->editLegalitasAtasan($id,$request);
            DB::connection('eusulan')->commit();
            return redirect('e-usulan/'.$id)
                ->with('status', 1)
                ->with('message', 'Legalitas atasan berhasil diubah')
                ->with('title', 'Sukses');

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('eusulan')->rollBack();
            return redirect()->back()
                ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                ->with('status', -1)
                ->with('title', 'Gagal');
        }
    }

    public function toggleEdit($id,Request $request)
    {
        try{

            DB::connection('eusulan')->beginTransaction();
            $toggle_edit = app('App\Http\Controllers\Eusulan\Usulan\EditController')->toggleEdit($id);
            DB::connection('eusulan')->commit();
            $message = ($toggle_edit == 1) ? 'Berhasil mengaktifkan edit untuk Usulan ini' : 'Berhasil menonaktifkan edit untuk Usulan ini';
            return redirect('e-usulan/'.$id)
                ->with('status', 1)
                ->with('message', $message)
                ->with('title', 'Sukses');

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('eusulan')->rollBack();
            return redirect()->back()
                ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                ->with('status', -1)
                ->with('title', 'Gagal');
        }
    }

    public function import($id,Request $request)
    {
        try{

            DB::connection('eusulan')->beginTransaction();
            app('App\Http\Controllers\Eusulan\Usulan\EditController')->import($id,$request);
            DB::connection('eusulan')->commit();
            return redirect('e-usulan/'.$id)
                ->with('status', 1)
                ->with('message', 'Import berhasil')
                ->with('title', 'Sukses');

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('eusulan')->rollBack();
            return redirect()->back()
                ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                ->with('status', -1)
                ->with('title', 'Gagal');
        }
    }
}

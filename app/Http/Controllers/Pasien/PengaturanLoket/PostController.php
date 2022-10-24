<?php

namespace App\Http\Controllers\Pasien\PengaturanLoket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
    public function create(Request $request)
    {
        DB::connection('patients')->beginTransaction();
        try {
            $data = app('App\Http\Controllers\Pasien\PengaturanLoket\CreateController')->create($request);

            $status = 1;
            $message = 'Pasien baru berhasil didaftarkan';
            $title = 'Berhasil!';
            
            DB::connection('patients')->commit();

            return redirect('pasien/pengaturan-loket')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        } catch (\Throwable $e) {
            DB::connection('patients')->rollBack();


            $status = 0;
            $message = 'Loket gagal didaftarkan';
            $title = 'Terjadi Kesalahan!';
            
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return redirect('pasien/pengaturan-loket')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }
    }

    public function update(Request $request, $id)
    {
        DB::connection('patients')->beginTransaction();
        try {
            $data = app('App\Http\Controllers\Pasien\PengaturanLoket\EditController')->update($request, $id);

            $status = 1;
            $message = 'Loket berhasil diedit';
            $title = 'Berhasil!';
            
            DB::connection('patients')->commit();

            return redirect('pasien/pengaturan-loket')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        } catch (\Throwable $e) {
            DB::connection('patients')->rollBack();


            $status = 0;
            $message = 'Loket gagal diedit';
            $title = 'Terjadi Kesalahan!';
            
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return redirect('pasien/pengaturan-loket')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }
    }

    public function hapus(Request $request, $id)
    {
        DB::connection('patients')->beginTransaction();
        try {
            $data = app('App\Http\Controllers\Pasien\PengaturanLoket\DeleteController')->delete($id);

            $status = 1;
            $message = 'Loket berhasil dihapus';
            $title = 'Berhasil!';

            
            DB::connection('patients')->commit();
            
            return redirect('pasien/pengaturan-loket')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        } catch (\Throwable $e) {
            DB::connection('patients')->rollBack();


            $status = 0;
            $message = 'Loket gagal dihapus';
            $title = 'Terjadi Kesalahan!';
            
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return redirect('pasien/pengaturan-loket')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }
    }
}

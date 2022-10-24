<?php

namespace App\Http\Controllers\Kepegawaian\MasterPangkat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Kepegawaian\MasterPangkat;

class PostController extends Controller
{
    public function baru(Request $request) {

        DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\MasterPangkat\CreateController')->create($request);
			DB::connection('kepegawaian')->commit();

			$status = $result['status'];
			$message = $result['message'];
			$title = $result['title'];

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

    public function edit(Request $request) {
        
        DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\MasterPangkat\EditController')->edit($request);
			DB::connection('kepegawaian')->commit();

			$status = $result['status'];
			$message = $result['message'];
			$title = $result['title'];

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

    public function delete($id, Request $request)
    {
        DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\MasterPangkat\DeleteController')->delete($id);
			DB::connection('kepegawaian')->commit();

			$status = $result['status'];
			$message = $result['message'];
			$title = $result['title'];

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

    // Pangkat Profil Pegawai
    public function pegawaiSave(Request $request, $id) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\MasterPangkat\CreateController')->pegawaiSave($request, $id);
			DB::connection('kepegawaian')->commit();

			$status = $result['status'];
			$message = $result['message'];
			$title = $result['title'];

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
    
    public function pegawaiDelete($id) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\MasterPangkat\DeleteController')->pegawaiDelete($id);
			DB::connection('kepegawaian')->commit();

			$status = $result['status'];
			$message = $result['message'];
			$title = $result['title'];

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

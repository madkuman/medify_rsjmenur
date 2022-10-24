<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai\Legalitas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller {

    public function simpanSIP(Request $request, $id) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\Pegawai\Legalitas\CreateController')->simpanSIP($request, $id);
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

	public function simpanSTR(Request $request, $id) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\Pegawai\Legalitas\CreateController')->simpanSTR($request, $id);
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

	public function simpanSKK(Request $request, $id) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\Pegawai\Legalitas\CreateController')->simpanSKK($request, $id);
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
    
    public function simpanKredensial(Request $request, $id) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\Pegawai\Legalitas\CreateController')->simpanKredensial($request, $id);
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

	public function simpanEvkin(Request $request, $id) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\Pegawai\Legalitas\CreateController')->simpanEvkin($request, $id);
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

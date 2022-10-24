<?php

namespace App\Http\Controllers\Kepegawaian\MasterJabatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller {

    public function simpanJabatan(Request $request) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\MasterJabatan\CreateController')->simpanJabatan($request);
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

	public function simpanJenisJabatan(Request $request) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\MasterJabatan\CreateController')->simpanJenisJabatan($request);
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

	public function pegawaiSave(Request $request, $id) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\MasterJabatan\CreateController')->pegawaiSave($request, $id);
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

	public function hapusJabatan($jabatan_id) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\MasterJabatan\DeleteController')->hapusJabatan($jabatan_id);
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

	public function hapusJenisJabatan($jenis_jabatan_id) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\MasterJabatan\DeleteController')->hapusJenisJabatan($jenis_jabatan_id);
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

	public function pegawaiDelete($id) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\MasterJabatan\DeleteController')->pegawaiDelete($id);
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

<?php

namespace App\Http\Controllers\Kepegawaian\MasterDepartemen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller {

	public function simpanDepartemen(Request $request) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\MasterDepartemen\CreateController')->simpanDepartemen($request);
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

	public function hapusDepartemen($departemen_id) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\MasterDepartemen\DeleteController')->hapusDepartemen($departemen_id);
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

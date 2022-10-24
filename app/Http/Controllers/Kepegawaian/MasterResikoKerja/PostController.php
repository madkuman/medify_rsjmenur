<?php

namespace App\Http\Controllers\Kepegawaian\MasterResikoKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller {

    public function simpan(Request $request) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\MasterResikoKerja\CreateController')->simpan($request);
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

	public function hapus($id) {
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$result = app('App\Http\Controllers\Kepegawaian\MasterResikoKerja\DeleteController')->hapus($id);
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

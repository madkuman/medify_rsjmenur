<?php

namespace App\Http\Controllers\Kepegawaian\MasterInstitusiPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller {

    public function baru(Request $request) {

		DB::connection('kepegawaian')->beginTransaction();
		try{
			$status_data = app('App\Http\Controllers\Kepegawaian\MasterInstitusiPendidikan\CreateController')->create($request);

			DB::connection('kepegawaian')->commit();
			if($status_data['status'] == 0) throw $error;

			$status = 1;
			$message = 'Berhasil menambahkan data';
			$title = 'Berhasil!';

			return redirect('/kepegawaian/master/institusi-pendidikan/')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {

			DB::connection('kepegawaian')->rollback();redirect('/kepegawaian/master/institusi-pendidikan/')
			->with('message', 'Kualifikasi tersebut sudah ada')
			->with('title', 'GAGAL')
			->with('status', 0);

            $status = -1;
            $message = 'Terjadi kesalahan! Silahkan coba lagi';
            $title = 'Gagal!';

            if(!empty($status_data['message'])) $message = $status_data['message'];

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
		}
	}

	public function edit(Request $request) {

		DB::connection('kepegawaian')->beginTransaction();
		try{
			
			$status_data = app('App\Http\Controllers\Kepegawaian\MasterInstitusiPendidikan\EditController')->edit($request);
			
			DB::connection('kepegawaian')->commit();
			if($status_data['status'] == 0) throw $error;

			$status = 1;
			$message = 'Berhasil mengubah data';
			$title = 'Berhasil!';

			return redirect('/kepegawaian/master/institusi-pendidikan/')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {

			DB::connection('kepegawaian')->rollback();
			$status = -1;
			$message = 'Terjadi kesalahan! Silahkan coba lagi';
			$title = 'Gagal!';
			if(!empty($status_data['message'])) $message = $status_data['message'];

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}

	public function delete($id) {

		DB::connection('kepegawaian')->beginTransaction();
		try{

			$status_data = app('App\Http\Controllers\Kepegawaian\MasterInstitusiPendidikan\DeleteController')->delete($id);

			DB::connection('kepegawaian')->commit();
			if($status_data['status'] == 0) throw $error;

			$status = 1;
			$message = 'Berhasil menghapus data';
			$title = 'Berhasil!';

			return redirect('/kepegawaian/master/institusi-pendidikan/')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {

			DB::connection('kepegawaian')->rollback();
			$status = -1;
			$message = 'Terjadi kesalahan! Silahkan coba lagi';
			$title = 'Gagal!';
			if(!empty($status_data['message'])) $message = $status_data['message'];

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}
}

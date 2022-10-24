<?php

namespace App\Http\Controllers\Kepegawaian\MasterTandaTangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
	public function baru(Request $request)
	{
		DB::connection('kepegawaian')->beginTransaction();
		try{
			// dd($request);
			$status = app('App\Http\Controllers\Kepegawaian\MasterTandaTangan\CreateController')->new($request->alias,$request->bagian_atas,$request->bagian_bawah);
			DB::connection('kepegawaian')->commit();

			$status = 1;
			$message = 'Berhasil menambahkan data';
			$title = 'Berhasil!';

			return redirect('/kepegawaian/master/tanda-tangan/')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) {
			DB::connection('kepegawaian')->rollback();
			$status = -1;
			$message = 'Terjadi kesalahan! Silahkan coba lagi';
			$title = 'Gagal!';
			if(!empty($status['message'])) $message = $status['message'];

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status)
			->withInput();
		}
	}

	public function edit($id, Request $request)
	{
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$status_data = app('App\Http\Controllers\Kepegawaian\MasterTandaTangan\EditController')->edit($id, $request->alias,$request->bagian_atas,$request->bagian_bawah);

			DB::connection('kepegawaian')->commit();
			if($status_data['status'] == 0) throw $error;

			$status = 1;
			$message = 'Berhasil mengubah data';
			$title = 'Berhasil!';

			return redirect('/kepegawaian/master/tanda-tangan/')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) {
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

	public function delete($id, Request $request)
	{
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$status_data = app('App\Http\Controllers\Kepegawaian\MasterTandaTangan\DeleteController')->delete($id);

			DB::connection('kepegawaian')->commit();
			if($status_data['status'] == 0) throw $error;

			$status = 1;
			$message = 'Berhasil menghapus data';
			$title = 'Berhasil!';

			return redirect('/kepegawaian/master/tanda-tangan/')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) {
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

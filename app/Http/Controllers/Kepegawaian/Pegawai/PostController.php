<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Imports\PegawaiImport;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    public function baru(Request $request)
	{
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$status = app('App\Http\Controllers\Kepegawaian\Pegawai\CreateController')->create($request);
			DB::connection('kepegawaian')->commit();

			$status = 1;
			$message = 'Berhasil menambahkan data';
			$title = 'Berhasil!';

			return redirect('/kepegawaian/pegawai/')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) {
			DB::connection('kepegawaian')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

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
			$status = app('App\Http\Controllers\Kepegawaian\Pegawai\EditController')->edit($id,$request);
			DB::connection('kepegawaian')->commit();

			$status = 1;
			$message = 'Berhasil menambahkan data';
			$title = 'Berhasil!';

			return redirect('/kepegawaian/pegawai/')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) {
			dd($e);
			DB::connection('kepegawaian')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
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
	
	public function delete($id)
	{
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$status = app('App\Http\Controllers\Kepegawaian\Pegawai\DeleteController')->delete($id);
			DB::connection('kepegawaian')->commit();

			$status = 1;
			$message = 'Berhasil menambahkan data';
			$title = 'Berhasil!';

			return redirect()->route('employees')
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

	public function import(Request $request)
	{
		DB::connection('kepegawaian')->beginTransaction();
		try{
			$status = app('App\Http\Controllers\Kepegawaian\Pegawai\CreateController')->import($request);
			DB::connection('kepegawaian')->commit();

			$status = 1;
			$message = 'Berhasil menambahkan data';
			$title = 'Berhasil!';

			return redirect('/kepegawaian/pegawai/')
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
}

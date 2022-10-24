<?php

namespace App\Http\Controllers\KamarOperasi\JenisOperasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;

class PostController extends Controller
{
	public function create(Request $request)
	{
		DB::connection('kamaroperasi')->beginTransaction();
		try
		{
			$alkes = app('App\Http\Controllers\KamarOperasi\JenisOperasi\CreateController')->create($request->nama);

			$status = 1;
			$message = 'Jenis Operasi Berhasil Ditambahkan';
			$title = 'Berhasil!';

			DB::connection('kamaroperasi')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kamaroperasi')->rollBack();
			

			$status = -1;
			$message = 'Jenis Operasi Gagal Ditambahkan';
			$title = 'Terjadi Kesalahan!';


			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}

	public function edit(Request $request)
	{
		DB::connection('kamaroperasi')->beginTransaction();
		try
		{
			$alkes = app('App\Http\Controllers\KamarOperasi\JenisOperasi\EditController')->edit($request->id, $request->nama);

			$status = 1;
			$message = 'Jenis Operasi Berhasil Diubah';
			$title = 'Berhasil!';

			DB::connection('kamaroperasi')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kamaroperasi')->rollBack();
			

			$status = -1;
			$message = 'Jenis Operasi Gagal Diubah';
			$title = 'Terjadi Kesalahan!';


			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}

	public function delete(Request $request)
	{
		DB::connection('kamaroperasi')->beginTransaction();
		try
		{
			$alkes = app('App\Http\Controllers\KamarOperasi\JenisOperasi\DeleteController')->delete($request->id);

			$status = 1;
			$message = 'Jenis Operasi Berhasil Dihapus';
			$title = 'Berhasil!';

			DB::connection('kamaroperasi')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kamaroperasi')->rollBack();
			

			$status = -1;
			$message = 'Jenis Operasi Gagal Dihapus';
			$title = 'Terjadi Kesalahan!';


			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}
}

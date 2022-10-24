<?php

namespace App\Http\Controllers\CSSD\AlkesSatuan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;

class PostController extends Controller
{
	public function baru(Request $request)
	{
		DB::connection('cssd')->beginTransaction();
		try
		{
			$alkes_id = $request->alkes_id;
			$stok = $request->stok;
			$jumlah_pemakaian = $request->jumlah_pemakaian;

			$alkes_satuan = app('App\Http\Controllers\CSSD\AlkesSatuan\CreateController')->create($alkes_id,$stok,$jumlah_pemakaian);
			
			$status = 1;
			$message = 'Alkes berhasil ditambahkan';
			$title = 'Berhasil!';

			DB::connection('cssd')->commit();

			return redirect('cssd/alkes/'.$alkes_id)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('cssd')->rollBack();

			$status = -1;
			$message = 'Alkes gagal ditambahkan';
			$title = 'Terjadi Kesalahan!';


			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}
}

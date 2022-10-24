<?php

namespace App\Http\Controllers\Farmasi\Produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Produksi;
use Carbon\Carbon;
use DOMPDF;
use DB;

class PostController extends Controller
{
	public function create($farmasi, Request $request)
	{

    	DB::connection('farmasi')->beginTransaction();
		try
		{
			$farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);
			$request->merge(['farmasi' => $farm]);
			app('App\Http\Controllers\Farmasi\Produksi\CreateController')->create($request->all());

			DB::connection('farmasi')->commit();
			return redirect()->back()
      					->with('message', 'Produksi baru berhasil dibuat')
      					->with('status', 1)
      					->with('title', 'Sukses');
		}
		catch (\Exception $e)
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    			DB::connection('farmasi')->rollBack();

	     	return redirect()->back()
	      				->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
	      				->with('status', -1)
                			->with('title', 'Gagal');
		}
	}
	public function produksi($farmasi, Request $request)
	{

    	DB::connection('farmasi')->beginTransaction();
		try
		{
			$farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);
			$request->merge(['farmasi' => $farm]);
			app('App\Http\Controllers\Farmasi\Produksi\EditController')->edit($request->all());

			DB::connection('farmasi')->commit();
			return redirect()->back()
      					->with('message', 'Produksi baru berhasil dibuat')
      					->with('status', 1)
      					->with('title', 'Sukses');
		}
		catch (\Exception $e)
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    			DB::connection('farmasi')->rollBack();

	     	return redirect()->back()
	      				->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
	      				->with('status', -1)
                			->with('title', 'Gagal');
		}
	}
}
<?php

namespace App\Http\Controllers\CSSD\Alkes;

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
			$data['nama'] = $request->nama;
			$data['batas_efektif'] = $request->batas_efektif;
			$data['keterangan'] = $request->keterangan;
			$data['prosedur_sterilisasi'] = $request->prosedur_sterilisasi;
			$stok_awal = $request->stok_awal;



			$alkes = app('App\Http\Controllers\CSSD\Alkes\CreateController')->create($data);
			$alkes_satuan = app('App\Http\Controllers\CSSD\AlkesSatuan\CreateController')->create($alkes->id,$stok_awal);

			$status = 1;
			$message = 'Alkes berhasil dibuat';
			$title = 'Berhasil!';

			DB::connection('cssd')->commit();

			return redirect('cssd/alkes/'.$alkes->id)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('cssd')->rollBack();

			$status = -1;
			$message = 'Alkes gagal dibuat';
			$title = 'Terjadi Kesalahan!';


			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		
	}

	public function edit(Request $request,$id)
	{
		DB::connection('cssd')->beginTransaction();
		try
		{
			$data['id'] = $request->id;
			$data['nama'] = $request->nama;
			$data['batas_efektif'] = $request->batas_efektif;
			$data['keterangan'] = $request->keterangan;
			$data['prosedur_sterilisasi'] = $request->prosedur_sterilisasi;
			$stok_awal = $request->stok_awal;



			$alkes = app('App\Http\Controllers\CSSD\Alkes\EditController')->edit($data);
			
			$status = 1;
			$message = 'Informasi Alkes berhasil diubah';
			$title = 'Berhasil!';

			DB::connection('cssd')->commit();

			return redirect('cssd/alkes/'.$alkes->id)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('cssd')->rollBack();

			$status = -1;
			$message = 'Alkes gagal diubah';
			$title = 'Terjadi Kesalahan!';


			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		
	}public function delete(Request $request,$id)
	{
		DB::connection('cssd')->beginTransaction();
		try
		{
			$alkes = app('App\Http\Controllers\CSSD\Alkes\DeleteController')->delete($id);
			
			$status = 1;
			$message = 'Alkes berhasil dihapus';
			$title = 'Berhasil!';

			DB::connection('cssd')->commit();

			return redirect('cssd/alkes')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('cssd')->rollBack();

			$status = -1;
			$message = 'Alkes gagal dihapus';
			$title = 'Terjadi Kesalahan!';


			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		
	}

}

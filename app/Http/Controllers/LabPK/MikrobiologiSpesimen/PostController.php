<?php

namespace App\Http\Controllers\LabPK\MikrobiologiSpesimen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
	public function create(Request $request)
	{
		$data = $request->all();
		DB::connection('lab_pk')->beginTransaction();
		try 
		{	
			$nama = $data['nama'];
			$nama_array = explode(",", $nama);

			foreach($nama_array as $nama)
			{
				$data['nama'] = $nama;
				$data = app('App\Http\Controllers\LabPK\MikrobiologiSpesimen\CreateController')->create($data);
			}
			DB::connection('lab_pk')->commit();

			return redirect('/labpk/pengaturan/mikrobiologi-spesimen/')
			->with('message','Spesimen berhasil ditambahkan')
			->with('status', 1)
			->with('title', 'Sukses');	
		} 
		catch (Exception $e) 
		{
			DB::connection('lab_pk')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			return back()
			->with('message','Spesimen gagal ditambahkan. Kesalahan Server hubungi admin')
			->with('status', -1)
			->with('title', 'Gagal');	
		}
	}
	public function edit(Request $request,$id)
	{
		$data = $request->all();
		DB::connection('lab_pk')->beginTransaction();
		try 
		{
			$form = app('App\Http\Controllers\LabPK\MikrobiologiSpesimen\EditController')->edit($data);
			DB::connection('lab_pk')->commit();

			return redirect('/labpk/pengaturan/mikrobiologi-spesimen/')
			->with('message','Spesimen berhasil diedit')
			->with('status', 1)
			->with('title', 'Sukses');	
		} 
		catch (Exception $e) 
		{
			DB::connection('lab_pk')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			return back()
			->with('message','Spesimen gagal diedit. Kesalahan Server hubungi admin')
			->with('status', -1)
			->with('title', 'Gagal');	
		}
	}

	public function delete(Request $request,$id)
	{
		$data = $request->all();
		DB::connection('lab_pk')->beginTransaction();
		try 
		{
			$form = app('App\Http\Controllers\LabPK\MikrobiologiSpesimen\DeleteController')->delete($id);
			DB::connection('lab_pk')->commit();

			$array['message'] = 'Spesimen berhasil dihapus';
			$array['type'] = 'success';
			$array['title'] = 'Berhasil';

			return json_encode($array);
		} 
		catch (Exception $e) 
		{
			DB::connection('lab_pk')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			$array['message'] = 'Spesimen gagal dihapus. Kesalahan Server hubungi admin';
			$array['type'] = 'error';
			$array['title'] = 'Gagal';
			return json_encode($array);
		}
	}
}

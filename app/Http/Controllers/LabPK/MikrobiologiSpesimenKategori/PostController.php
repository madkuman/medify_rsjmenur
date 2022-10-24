<?php

namespace App\Http\Controllers\LabPK\MikrobiologiSpesimenKategori;

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
			$data = app('App\Http\Controllers\LabPK\MikrobiologiSpesimenKategori\CreateController')->create($data);
			DB::connection('lab_pk')->commit();

			return redirect('/labpk/pengaturan/mikrobiologi-spesimen-kategori/')
			->with('message','Kategori berhasil ditambahkan')
			->with('status', 1)
			->with('title', 'Sukses');	
		} 
		catch (Exception $e) 
		{
			DB::connection('lab_pk')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			return back()
			->with('message','Kategori gagal ditambahkan. Kesalahan Server hubungi admin')
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
			$form = app('App\Http\Controllers\LabPK\MikrobiologiSpesimenKategori\EditController')->edit($data);
			DB::connection('lab_pk')->commit();

			return redirect('/labpk/pengaturan/mikrobiologi-spesimen-kategori/')
			->with('message','Kategori berhasil diedit')
			->with('status', 1)
			->with('title', 'Sukses');	
		} 
		catch (Exception $e) 
		{
			DB::connection('lab_pk')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			return back()
			->with('message','Kategori gagal diedit. Kesalahan Server hubungi admin')
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
			$form = app('App\Http\Controllers\LabPK\MikrobiologiSpesimenKategori\DeleteController')->delete($id);
			DB::connection('lab_pk')->commit();

			$array['message'] = 'Kategori berhasil dihapus';
			$array['type'] = 'success';
			$array['title'] = 'Berhasil';

			return json_encode($array);
		} 
		catch (Exception $e) 
		{
			DB::connection('lab_pk')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			$array['message'] = 'Kategori gagal dihapus. Kesalahan Server hubungi admin';
			$array['type'] = 'error';
			$array['title'] = 'Gagal';
			return json_encode($array);
		}
	}
}

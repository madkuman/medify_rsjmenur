<?php

namespace App\Http\Controllers\Admin\Lokasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use BugSnag;
use Auth;
use App\Models\Hospital\Lokasi;

class PostController extends Controller
{
	public function create(Request $request)
	{	    	
		DB::beginTransaction();
		try 
		{		
			if(!empty($request->input('id'))) $lokasi = Lokasi::find($request->id);
			else $lokasi = new Lokasi;

			$lokasi->nama = $request->nama;
			$lokasi->lokasi_departemen_id = $request->lokasi_departemen_id;
			$lokasi->kategori_keuangan_id = $request->kategori_keuangan_id;
			$lokasi->zona_ppi_id = $request->zona_ppi_id;
			$lokasi->save();


			DB::commit();

			return redirect('/admin/lokasi')
			->with('message','Lokasi berhasil ditambahkan')
			->with('status', 1)
			->with('title', 'Sukses');	
		} 
		catch (Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();

			return redirect('/admin/lokasi')
			->with('message','Lokasi gagal ditambahkan')
			->with('status', -1)
			->with('title', 'Gagal');	
		}

	}

	public function delete($id)
	{
		DB::beginTransaction();
		try 
		{		
			$lokasi = Lokasi::find($id);
			$lokasi->delete();

			DB::commit();

			return redirect('/admin/lokasi')
			->with('message','Lokasi berhasil ditambahkan')
			->with('status', 1)
			->with('title', 'Sukses');	
		} 
		catch (Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();

			return redirect('/admin/lokasi')
			->with('message','Lokasi gagal dihapus')
			->with('status', -1)
			->with('title', 'Gagal');	
		}    	
	}
}

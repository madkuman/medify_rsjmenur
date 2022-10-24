<?php

namespace App\Http\Controllers\Admin\LokasiZonaPPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use BugSnag;
use Auth;
use App\Models\Hospital\LokasiZonaPPI;

class PostController extends Controller
{
	public function create(Request $request)
	{	    	
		DB::beginTransaction();
		try 
		{		
			if(!empty($request->input('id'))) $lokasi = LokasiZonaPPI::find($request->id);
			else $lokasi = new LokasiZonaPPI;

			$lokasi->zona = $request->zona;
			$lokasi->deskripsi = $request->deskripsi;
			$lokasi->save();


			DB::commit();

			return redirect('/admin/lokasi-zona-ppi')
			->with('message','Zona PPI berhasil ditambahkan')
			->with('status', 1)
			->with('title', 'Sukses');	
		} 
		catch (Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();

			return redirect('/admin/lokasi-zona-ppi')
			->with('message','Zona PPI gagal ditambahkan')
			->with('status', -1)
			->with('title', 'Gagal');	
		}

	}

	public function delete($id)
	{
		DB::beginTransaction();
		try 
		{		
			$lokasi = LokasiZonaPPI::find($id);
			$lokasi->delete();

			DB::commit();

			return redirect('/admin/lokasi-zona-ppi')
			->with('message','Lokasi berhasil ditambahkan')
			->with('status', 1)
			->with('title', 'Sukses');	
		} 
		catch (Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();

			return redirect('/admin/lokasi-zona-ppi')
			->with('message','Lokasi gagal dihapus')
			->with('status', -1)
			->with('title', 'Gagal');	
		}    	
	}
}

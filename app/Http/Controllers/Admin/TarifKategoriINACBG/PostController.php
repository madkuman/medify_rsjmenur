<?php

namespace App\Http\Controllers\Admin\TarifKategoriINACBG;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\TarifKategoriINACBG;
use App\Models\Keuangan\Tarif;
use DB;
use Auth;

class PostController extends Controller
{
	public function add(Request $request)
	{
		$data['nama'] = $request->input('nama');
		$data['slug'] = $request->input('slug');

		DB::beginTransaction();
		try
		{	
			# find item with same 'slug', abort if found
	    	$slug = TarifKategoriINACBG::where('slug', $data['slug'])->first();
	    	if (!empty($slug)) {
	    		$kategori = 'Terdapat Kategori dengan slug yang sama';
	    	}
	    	else {
	    		if(!empty($request->id))
				{
					$kategori = TarifKategoriINACBG::find($request->id);
					$kategori->nama = $data['nama'];
					$kategori->slug = $data['slug'];
					$kategori->updated_by = Auth::user()->id;
					$kategori->save();
				}
				else
				{
					$kategori = new TarifKategoriINACBG;
					$kategori->nama = $data['nama'];
					$kategori->slug = $data['slug'];
					$kategori->created_by = Auth::user()->id;
					$kategori->save();
				}
	    	}

			DB::commit();

			if (is_string($kategori)) {
				return back()
				->with('message', $kategori)
				->with('status', -1)
				->with('title', 'Gagal');
			}
			else {
				return back()
				->with('message','Data berhasil ditambahkan / diubah')
				->with('status', 1)
				->with('title', 'Sukses');
			}
		}
		catch(\Exception $e)
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();

			return back()
			->with('message','Data gagal ditambahkan / diubah')
			->with('status', -1)
			->with('title', 'Gagal');
		}


	}

	public function delete(Request $request)
	{
		DB::beginTransaction();
		try
		{	
			$kategori = TarifKategoriINACBG::find($request->id);
			$kategori->deleted_by = Auth::user()->id;
			$kategori->save();

			$kategori->delete();

			DB::commit();

			return back()
			->with('message','Data berhasil dihapus')
			->with('status', 1)
			->with('title', 'Sukses');
		}
		catch(\Exception $e)
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();

			return back()
			->with('message','Data gagal dihapus')
			->with('status', -1)
			->with('title', 'Gagal');
		}
	}
}

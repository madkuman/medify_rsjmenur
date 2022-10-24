<?php

namespace App\Http\Controllers\Admin\CaraPulangINACBG;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterCaraPulang;
use App\Models\Hospital\MasterCaraPulangINACBG;
use DB;
use Auth;

class PostController extends Controller
{
    public function add(Request $request)
	{
		$data['nama'] = $request->input('nama');
		$data['kode'] = $request->input('kode');

		DB::beginTransaction();
		try
		{	
			# find item with same 'kode', abort if found
	    	$kode = MasterCaraPulangINACBG::where('kode', $data['kode'])->first();
	    	if (!empty($kode)) {
	    		$cara_pulang = 'Terdapat Kategori dengan kode yang sama';
	    	}
	    	else {
	    		if(!empty($request->id))
				{
					$cara_pulang = MasterCaraPulangINACBG::find($request->id);
					$cara_pulang->nama = $data['nama'];
					$cara_pulang->kode = $data['kode'];
					$cara_pulang->updated_by = Auth::user()->id;
					$cara_pulang->save();
				}
				else
				{
					$cara_pulang = new MasterCaraPulangINACBG;
					$cara_pulang->nama = $data['nama'];
					$cara_pulang->kode = $data['kode'];
					$cara_pulang->created_by = Auth::user()->id;
					$cara_pulang->save();
				}
	    	}

			DB::commit();

			if (is_string($cara_pulang)) {
				return back()
				->with('message', $cara_pulang)
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
			$cara_pulang = MasterCaraPulang::where('cara_pulang_inacbg_id',$request->id)->get();
			if(count($cara_pulang) > 0)
			{
				return back()
				->with('message','Item ini masih digunakan oleh '.count($cara_pulang).' Cara Pulang')
				->with('status', 1)
				->with('title', 'Sukses');
			}
			else{
				$cara_pulang_inacbg = MasterCaraPulangINACBG::find($request->id);
				$cara_pulang_inacbg->deleted_by = Auth::user()->id;
				$cara_pulang_inacbg->save();

				$cara_pulang_inacbg->delete();
			}	

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

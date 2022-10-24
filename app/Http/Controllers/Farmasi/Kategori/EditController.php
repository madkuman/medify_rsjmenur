<?php

namespace App\Http\Controllers\Farmasi\Kategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Kategori;
use App\Models\Farmasi\ItemsKategori;
use DB;
use Bugsnag;
use Image;
use File;
use Storage;

class EditController extends Controller
{
    public function edit(Request $request, $farmasi)
	{
		//dd($request);
		$name = $request->input('nama');
		$id = $request->input('id');
		$is_kandungan = $request->input('is_kandungan') ? 1 : 0;

		DB::connection('farmasi')->beginTransaction();
		
		try {
			$kategori = Kategori::find($id);
			if ($name == $kategori->nama) {
				# code...
			}
			else{
				if(!is_null(Kategori::where('nama', $name)->first())) 
					return redirect('/farmasi/'.$farmasi.'/kategori/'.$kategori->slug)
						->with('status', -1)
						->with('message', 'Kategori yang sama telah terdaftar')
						->with('title', 'Gagal');	
			}

			$kategori->nama = $name;
			$kategori->is_kandungan = $is_kandungan ?? 0;
			$kategori->save();
			DB::connection('farmasi')->commit();
			return redirect('farmasi/'.$farmasi.'/kategori/'.$kategori->slug)
						->with('status', 1)
						->with('message', 'Kategori berhasil diubah')
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

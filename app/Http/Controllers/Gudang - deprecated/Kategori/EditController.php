<?php

namespace App\Http\Controllers\Gudang\Kategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Kategori;
use App\Models\Gudang\ItemsKategori;
use DB;
use Bugsnag;
use Image;
use File;
use Storage;

class EditController extends Controller
{
    public function edit(Request $request)
	{
		//dd($request);
		$name = $request->input('nama');
		$id = $request->input('id');

		
		
		try {
			$kategori = Kategori::find($id);
			if ($name == $kategori->nama) {
				# code...
			}
			else{
				if(!is_null(Kategori::where('nama', $name)->first())) 
					return redirect('/gudang/kategori/'.$kategori->slug)
						->with('status', -1)
						->with('message', 'Kategori telah terdaftar')
						->with('title', 'Gagal');	
			}

			$kategori->nama = $name;
			$kategori->save();
			
			return redirect('gudang/kategori/'.$kategori->slug)
						->with('status', 1)
						->with('message', 'Kategori berhasil diubah')
						->with('title', 'Sukses');
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    		

	     	return redirect()->back()
	      				->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
	      				->with('status', -1)
                		->with('title', 'Gagal');
		}
	}
}

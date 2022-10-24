<?php

namespace App\Http\Controllers\Gudang\Kategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Kategori;
use App\Models\Gudang\ItemsKategori;
use DB;
use Auth;
use Bugsnag;
use Image;
use File;
use Storage;

class CreateController extends Controller
{
    public function create(Request $request)
	{
		//dd($request);
		$name = $request->input('nama');

		

		try{
			$kategori = new Kategori;
			$kategori->nama = $name;
			$kategori->created_by = Auth::user()->id;

			$slug = preg_replace('~[^\pL\d]+~u', '-', $name);
			$slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);// transliterate
			$slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
			$slug = trim($slug, '-'); // trim
			$slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
			$slug = strtolower($slug); // lowercase
			$metal_slug = $slug;

			$i = 1;
			while(!is_null(Kategori::where("slug",$slug)->first())){
				$i++;
				$slug = $metal_slug."_".$i;
			}
			
			$kategori->slug = $slug;	
			$kategori->save();

			
			return redirect('/gudang/kategori/'.$slug)
				->with('status', 1)
				->with('message', 'Supplier baru berhasil dibuat')
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

	public function createByName($name)
	{
		$kategori = new Kategori;
		$kategori->nama = $name;
		$kategori->created_by = Auth::user()->id;

		$slug = preg_replace('~[^\pL\d]+~u', '-', $name);
		$slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);// transliterate
		$slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
		$slug = trim($slug, '-'); // trim
		$slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
		$slug = strtolower($slug); // lowercase
		$metal_slug = $slug;

		$i = 1;
		while(!is_null(Kategori::where("slug",$slug)->first())){
			$i++;
			$slug = $metal_slug."_".$i;
		}
		
		$kategori->slug = $slug;	
		$kategori->save();

		return $kategori;
	}
}

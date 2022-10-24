<?php

namespace App\Http\Controllers\Gudang\Items;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Items;
use App\Models\Gudang\ItemsTemplate;
use App\Models\Gudang\Pengadaan;
use App\Models\Gudang\Kategori;
use App\Models\Gudang\ItemsKategori;
use App\Models\Farmasi\TipeObat;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DB;
use Bugsnag;
use File;
use Image;
use DateTime;
use Auth;

class CreateController extends Controller
{
    public function create(Request $request)
	{	

		
		DB::connection('farmasi')->beginTransaction();

		try {
			$item = $this->createAPI($request);

			
			DB::connection('farmasi')->commit();
			

			return redirect('gudang/item/'.$item->slug)
				->with('status', 1)
				->with('message', 'Barang berhasil dibuat')
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


	public function createAPI(Request $request)
	{
		if ($request->hasFile('input_image')) {
			$file_ext = $request->input_image->extension();
			if($file_ext != 'jpeg' && $file_ext != 'png') return $response->setStatusCode(400, 'File type Invalid'); 
			$images = $this->uploadImage($request);
		}

		$name = $request->input('nama');
		$desc = $request->input('keterangan');
		$satuan = $request->input('satuan');
		$harga = $request->input('harga');
		$jenis = $request->input('jenis');
		$stok = $request->input('batasan_stok');
		$kadaluarsa = $request->input('batasan_kadaluarsa');
		$waktu = $request->input('satuan_waktu');
		$kategori = $request->input('kategori');
		
		$item = new ItemsTemplate;
		$item->nama = $name;
		$item->deskripsi = $desc;
		$item->satuan = $satuan;
		$item->harga = $harga;
		$item->jenis = $jenis;
		$item->min_stok = $stok;
		$item->min_kadaluarsa = $kadaluarsa*$waktu;
		$item->created_by = Auth::user()->id;

		$slug = preg_replace('~[^\pL\d]+~u', '-', $name);
		$slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);// transliterate
		$slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
		$slug = str_replace('%', '', $slug);
		$slug = trim($slug, '-'); // trim
		$slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
		$slug = strtolower($slug); // lowercase
		$metal_slug = $slug;

		$i = 1;
		while(!is_null(ItemsTemplate::where("slug",$slug)->first())){
			$i++;
			$slug = $metal_slug."_".$i;
		}
		
		$item->slug = $slug;
		$item->save();

		$temp = TipeObat::where('nama',$satuan)->first();
		if(!$temp)
		{
			$tuan = new TipeObat;
			$tuan->nama = $satuan;
			$tuan->save();
		}

		if($kategori)
		{
			foreach ($kategori as $arr) {
				if(!is_numeric($arr)) $arr = app('App\Http\Controllers\Gudang\Kategori\CreateController')->createByName($arr)->id;
				$gori = new ItemsKategori;
				$gori->kategori_id = $arr;
				$gori->item_template_id = $item->id;

				/*$slug = preg_replace('~[^\pL\d]+~u', '-', $arr);
				$slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);// transliterate
				$slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
				$slug = trim($slug, '-'); // trim
				$slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
				$slug = strtolower($slug); // lowercase
				$metal_slug = $slug;

				$gori->slug = $metal_slug;*/
				
				$gori->save();
			}
		}

		app('App\Http\Controllers\Farmasi\Items\CreateController')->createItemEach($item->id);
		return $item;
	}

	public function newItem($item, $qty = 0, $expired = null, $harga = null)
	{
		if(!is_null($expired))
		{
			$date = Carbon::createFromFormat('d/m/Y', $expired)->toDateTimeString();
		}
		else $date = null;

		$temp = Items::where('item_template_id', $item)->whereDate('kadaluarsa',date('Y-m-d', strtotime($date)))->first();

		if($temp)
		{
			$temp->jumlah += $qty;
			// $temp->harga = $harga;
			$temp->save();

			return $temp;
		}
		else
		{
			$new_log = new Items;
			$new_log->item_template_id = $item;
			$new_log->jumlah = $qty;
			$new_log->kadaluarsa = $date;
			// $new_log->harga = $harga;
			$new_log->save();
			return $new_log;
		}
	}

	public function newReturItem($item, $qty = 0, $expired = null)
	{
		$new_log = new Items;
		$new_log->item_template_id = $item;
		$new_log->jumlah_total = $qty;
		$new_log->status = 0;
		//$new_log->jumlah_sedia = $qty;
		$new_log->kadaluarsa = $expired;
		$new_log->save();
		
		return $new_log;
	}

	/*private function uploadImage($request)
	{

		//declare
		if($request->input('type') == 1)	$folder = 'Warehouse/drugs';
		else 								$folder = 'Warehouse/items';
		$public_folder = public_path('uploads/'.$folder);

		//distore di local
		$old_path = $request->input_image->store($folder);
		$ext = $request->input_image->extension();
		$filename = str_replace(' ', '_', $request->input('name')).'.'.$ext;

		//move file
		$upload = $request->file('input_image')->move($public_folder, $old_path);
		Storage::delete($old_path);

		$file_url = 'uploads/'.$old_path;

		$thumb_filename = 'thumb_'.$filename;
		$resized_filename = 'big_'.$filename;

		// open an image file
		$img = Image::make($file_url);
		$img->fit(300);
		$img->save($public_folder.'/'.$thumb_filename);


		// open an image file
		$img = Image::make($file_url);
		$img->resize(null, 500, function ($constraint) {
			$constraint->aspectRatio();
		});

		$img->save($public_folder.'/'.$resized_filename);

		$images = array(
			'original'=> 'uploads/'.$folder.'/'.$filename,
			'thumb' => 'uploads/'.$folder.'/'.$thumb_filename,
			'resized' => 'uploads/'.$folder.'/'.$resized_filename
			);

		return $images;		
	}*/
}

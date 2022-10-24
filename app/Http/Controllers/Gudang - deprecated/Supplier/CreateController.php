<?php

namespace App\Http\Controllers\Gudang\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Supplier;
use DB;
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
		//$type = $request->input('type');
		$address = $request->input('alamat');
		$phone = $request->input('telepon');
		$desc = $request->input('keterangan');
		$agent = $request->input('nama_perwakilan');
		$agent_phone = $request->input('telepon_perwakilan');
		$npwp = $request->input('npwp');
		//$image = $request->file('image');

		/*if(!is_null(Supplier::where('nama', $name)->first())) return redirect('/warehouse/supplier/new')->with('failed', 'Nama Supplier telah terdaftar');*/
		

		try{
			$supplier = new Supplier;
			$supplier->nama = $name;
			//$supplier->jenis = $type;
			$supplier->alamat = $address;
			$supplier->telepon = $phone;
			$supplier->deskripsi = $desc;
			$supplier->agen = $agent;
			$supplier->telepon_agen = $agent_phone;
			$supplier->npwp_agen = $npwp;

			$slug = preg_replace('~[^\pL\d]+~u', '-', $name);
			$slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);// transliterate
			$slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
			$slug = trim($slug, '-'); // trim
			$slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
			$slug = strtolower($slug); // lowercase
			$metal_slug = $slug;

			$i = 1;
			while(!is_null(Supplier::where("slug",$slug)->first())){
				$i++;
				$slug = $metal_slug."_".$i;
			}
			
			$supplier->slug = $slug;	

			//Uploading Image
			if ($request->hasFile('image')) {
				$img = $this->uploadImage($request,$name);
				$supplier->foto = $img['thumb'];
			}
			
			$supplier->save();

			
			return redirect('/gudang/supplier/'.$slug)
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

	private function uploadImage($request,$name)
	{


		//declare folder
		$folder = 'warehouse/supplier';
		$public_folder = public_path('uploads/'.$folder);

		//getextension
		$ext = $request->image->extension();

		//create filename
		$filename = $this->createFilename($name,$public_folder,$ext);

		//join extension with filename
		$filename.='.'.$ext;

		//store local storage
		$old_path = $request->image->storeAs($folder, $filename);

		//move to public path (dest,source)
		$new_path = $request->file('image')->move($public_folder, $old_path);

		//delete file di storage
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
			'ori'=> 'uploads/'.$folder.'/'.$filename,
			'thumb' => 'uploads/'.$folder.'/'.$thumb_filename,
			'big' => 'uploads/'.$folder.'/'.$resized_filename
		);

		return $images;
	}

	private function createFilename($name,$public_folder,$ext)
	{

    		//slug filename
		$filename = $name;
		$filename = substr($filename, 0,10);
		$filename = preg_replace('~[^\pL\d]+~u', '-', $filename);
		$filename = iconv('utf-8', 'us-ascii//TRANSLIT', $filename);// transliterate
		$filename = preg_replace('~[^-\w]+~', '', $filename); // remove unwanted characters
		$filename = trim($filename, '-'); // trim
		$filename = preg_replace('~-+~', '-', $filename); // remove duplicate -
		$filename = strtolower($filename); // lowercase

		$filename_check = $filename;
		$i = 2;


		//if file exist change name;
		while(file_exists( $public_folder .'/'. $filename_check .'.'. $ext)) {
			$filename_check = $filename;
			$filename_check.= $i;
			$i++;
		}

		$filename = $filename_check;


		return $filename;
		$images = array(
			'original'=> $folder.'/'.$filename,
			'thumb' => $folder.'/'.$thumb_filename
		);

		return $images;		
	}
}

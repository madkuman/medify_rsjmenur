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

class EditController extends Controller
{
    public function edit(Request $request)
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
		$id = $request->input('id');

		
		
		try {
			$supplier = Supplier::find($id);
			if ($name == $supplier->nama) {
				# code...
			}
			else{
				if(!is_null(Supplier::where('nama', $name)->first())) return redirect('/gudang/supplier/'.$supplier->slug)->with('failed', 'Nama Supplier telah terdaftar');	
			}

			//Uploading Image
			if ($request->hasFile('image')) {
				$img = $this->uploadImage($request,$name);
				//dd($img);
			}

			$supplier->nama = $name;
			//$supplier->jenis = $type;
			$supplier->alamat = $address;
			$supplier->telepon = $phone;
			$supplier->deskripsi = $desc;
			$supplier->agen = $agent;
			$supplier->telepon_agen = $agent_phone;
			$supplier->npwp_agen = $npwp;
			if($request->hasFile('image')) $supplier->foto = $img['thumb'];

			$supplier->save();
			
			return redirect('gudang/supplier/'.$supplier->slug)
						->with('status', 1)
						->with('message', 'Supplier berhasil diedit')
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
		$folder = 'Warehouse/supplier';
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

		if(file_exists($thumb_filename))
		{
			Storage::delete($thumb_filename);
			Storage::delete($resized_filename);
		}
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

<?php

namespace App\Http\Controllers\Farmasi\Farmasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Farmasi;
use DB,Auth;
use Bugsnag;
use Image;
use File;
use Storage;

class CreateController extends Controller
{
    public function create(Request $request)
	{
		//dd($request);
		ini_set('max_execution_time', 300);
		
		$name = $request->input('name');
		$phone = $request->input('phone');
		$desc = $request->input('desc');
		$image = $request->file('image');

		DB::connection('keuangan')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		DB::connection('farmasi')->beginTransaction();

		try {
			$pharmacy = new Farmasi;
			$pharmacy->nama = $name;
			$pharmacy->telepon = $phone;
			$pharmacy->deskripsi = $desc;
			$pharmacy->jenis = $request->jenis;

			$slug = preg_replace('~[^\pL\d]+~u', '-', $name);
			$slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);// transliterate
			$slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
			$slug = trim($slug, '-'); // trim
			$slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
			$slug = strtolower($slug); // lowercase
			$metal_slug = $slug;

			$i = 1;
			while(!is_null(Farmasi::where("slug",$slug)->first())){
				$i++;
				$slug = $metal_slug."_".$i;
			}
			
			$pharmacy->slug = $slug;	

			//Uploading Image
			if ($request->hasFile('image')) {
				$img = $this->uploadImage($request,$name);
				$pharmacy->foto = $img['thumb'];
			}
			$pharmacy->save();


			$name ='Farmasi - '.$pharmacy->nama;
			$slug = 'farmasi';

			$kategori_keuangan = app('App\Http\Controllers\Keuangan\Kategori\CreateController')->createBySlugName($slug,$name);		
			$lokasi = app('App\Http\Controllers\Hospital\Lokasi\CreateController')->createBySlug($name,$slug,$kategori_keuangan->id);
			
			$pharmacy->lokasi_id = $lokasi->id;
			$pharmacy->save();

			app('App\Http\Controllers\Farmasi\Items\CreateController')->createStarter($pharmacy->id);
			
			$modul_url = 'farmasi/'.$pharmacy->slug;

			$group = app('App\Http\Controllers\Group\CreateController')->create($name, $modul_url, 1);

			$pharmacy->group_id = $group->id;
			$pharmacy->save();

			DB::connection('keuangan')->commit();
			DB::connection('mysql')->commit();
			DB::connection('farmasi')->commit();
			return redirect('/farmasi')
			->with('message', 'Farmasi baru berhasil dibuat')
			->with('status', 1)
			->with('title', 'Sukses');
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('keuangan')->rollBack();
			DB::connection('mysql')->rollBack();
    		DB::connection('farmasi')->rollBack();

	     	return redirect('/farmasi')
	     	->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lag')
			->with('status', -1)
			->with('title', 'Gagal');
		}
		
		/*else
			return redirect('/apotek/new')->with('failed', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi');*/
	}

	private function uploadImage($request,$name)
	{
		//declare folder
		$folder = 'farmasi';
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

<?php

namespace App\Http\Controllers\Admin\DataImport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\DataImport;
use App\Jobs\QueueArtisan;
use Auth;

class PostController extends Controller
{
	public function create(Request $request)
	{
		foreach($request->file as $file){
			$file_data = app('App\Http\Controllers\Functions\ImageUploader')->upload($file,'data-import',$request->jenis);

			$data = new DataImport;
			$data->jenis = $request->jenis;
			$data->file_path = $file_data['public_path'].'/'.$file_data['name'];
			$data->nama = $file_data['name_original'];
			$data->created_by = Auth::user()->id;
			$data->save();

   		 	$return['id'] = $data->id;
        	dispatch(new QueueArtisan('data-import:'.$request->jenis,$return));
		}

		return back()
		->with('message', "Berhasil Mengupload Dokumen")
		->with('title',	"Proses Import Akan Segera Dimulai")
		->with('status', 1);
    }
}

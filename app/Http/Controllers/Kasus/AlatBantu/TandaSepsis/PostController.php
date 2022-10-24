<?php

namespace App\Http\Controllers\Kasus\AlatBantu\TandaSepsis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use Auth;
use DB;

define('relasi', []);

class PostController extends Controller
{

	public function create($nomor_kasus, Request $request)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$input = $request->all();

		foreach($input as $key => $val){
			if($key == '_token') continue;
			if($key == 'lokasi_id') continue;
			$array[$key] = $val;
		}

		$alatBantu = new AlatBantu;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->type = 'sepsis';
		$alatBantu->lokasi_id = $request->lokasi_id;
		$alatBantu->val = json_encode($array);
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->save();

		$status = 1;
		$message = 'Form spesis berhasil ditambahkan';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','kejadian-jatuh',$alatBantu->id);


		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function delete($nomor_kasus, Request $req)
	{	
		try {
			$hemo = AlatBantu::find($req->id);
			$hemo->delete();

			$status = 1;
			$message = 'Sepsis berhasil dihapus';
			$title = 'Berhasil!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			$status = -1;
			$message = 'Sepsis gagal dibuat!';
			$title = 'Error!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}		
	}
}
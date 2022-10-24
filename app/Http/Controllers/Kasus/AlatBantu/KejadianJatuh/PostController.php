<?php

namespace App\Http\Controllers\Kasus\AlatBantu\KejadianJatuh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatKejadianJatuh;
use Auth;
use DB;

define('relasi', []);

class PostController extends Controller
{

	public function create($nomor_kasus, Request $request)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		
		$alatBantu = new AlatKejadianJatuh;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->lokasi_id = $request->lokasi_id;
		$alatBantu->akibat_jatuh = $request->akibat_jatuh;
		$alatBantu->keterangan = $request->keterangan;
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->save();


		$status = 1;
		$message = 'Kejadian Jatuh berhasil ditambahkan';
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
			$hemo = AlatKejadianJatuh::find($req->id);
			$hemo->deleted_by = Auth::user()->id;
			$hemo->save();
			$hemo->delete();

			$status = 1;
			$message = 'Kejadian jatuh berhasil dihapus';
			$title = 'Berhasil!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			$status = -1;
			$message = 'Kejadian jatuh gagal dibuat!';
			$title = 'Error!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}		
	}
}
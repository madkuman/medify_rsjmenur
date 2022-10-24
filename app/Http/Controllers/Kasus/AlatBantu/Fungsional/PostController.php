<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Fungsional;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use Auth;
use DB;

define('relasi', []);

class PostController extends Controller
{
	public function create($nomor_kasus, Request $req)
	{
		// dd($req);
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$fungsional = [];
		$input = $req->all();
		foreach($input as $key => $val){
			if($key == '_token') continue;
			$fungsional[$key] = $val;
		}

		$alatBantu = new AlatBantu;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->type = "Fungsional";
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->val = json_encode($fungsional);
		$alatBantu->save();


		$status = 1;
		$message = 'Asesmen Pengkajian Fungsional berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-Fungsional',$alatBantu->id);


		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}
}
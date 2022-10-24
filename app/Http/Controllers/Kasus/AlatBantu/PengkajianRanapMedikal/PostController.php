<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PengkajianRanapMedikal;

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
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$ranap_medikal = [];
		$input = $req->all();
		foreach($input as $key => $val){
			if($key == '_token') continue;
			$ranap_medikal[$key] = $val;
		}

		$alatBantu = new AlatBantu;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->type = "Pengkajian Awal Ranap - Medikal Bedah";
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->val = json_encode($ranap_medikal);
		$alatBantu->save();


		$status = 1;
		$message = 'Asesmen Pengkajian Awal Ranap - Medikal Bedah berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-Pengkajian Awal Ranap Medikal Bedah',$alatBantu->id);


		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}
}
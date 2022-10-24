<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PengkajianIGD;

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

		$pengkajian = [];
		$input = $req->all();
		foreach($input as $key => $val){
			if($key == '_token' || $key == 'pengkajian_id') continue;
			$pengkajian[$key] = $val;
		}

		$alatBantu = (!empty($input['pengkajian_id'])) ? AlatBantu::find($input['pengkajian_id']) : new AlatBantu ;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->type = "Pengkajian IGD";
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->val = json_encode($pengkajian);
		$alatBantu->save();

		if (!empty($input['pengkajian_id'])) {
			$status = 1;
			$message = 'Asesmen Pengkajian IGD berhasil diubah';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'edit','alat-Pengkajian IGD',$alatBantu->id);
		} else {
			$status = 1;
			$message = 'Asesmen Pengkajian IGD berhasil dibuat';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','alat-Pengkajian IGD',$alatBantu->id);
		}

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}
}
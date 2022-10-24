<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Perinatal;

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

		$perinatal = [];
		$input = $req->all();
		foreach($input as $key => $val){
			if($key == '_token')	continue;
			$perinatal[$key] = $val;
		}

		$alatBantu = new AlatBantu;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->type = "Perinatal";
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->val = json_encode($perinatal);
		$alatBantu->save();


		$status = 1;
		$message = 'Asesmen Perinatal berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-perinatal',$alatBantu->id);


		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function edit($nomor_kasus, Request $req)
	{

		$perinatal = [];
		$input = $req->all();
		foreach($input as $key => $val){
			if($key == '_token' || $key == 'asesmen_id')	continue;
			$perinatal[$key] = $val;
		}

		try {
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			DB::connection('kasus')->beginTransaction();

			$alatBantu = AlatBantu::find($input['asesmen_id']);
			$alatBantu->val = json_encode($perinatal);
			$alatBantu->save();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'edit','alat-perinatal',$alatBantu->id);	

			$status = 1;
			$message = 'Asesmen Perinatal berhasil diupdate';
			$title = 'Berhasil!';
			DB::connection('kasus')->commit();

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollBack();
			$status = 1;
			$message = 'Asesmen Perinatal gagal diupdate';
			$title = 'Gagal!';
		}

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}
}
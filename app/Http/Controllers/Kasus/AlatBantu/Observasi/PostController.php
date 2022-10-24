<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Observasi;

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
		DB::connection('kasus')->beginTransaction();
		try {
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$observasi = [];
			$input = $req->all();
			foreach($input as $key => $val){
				if($key == '_token') continue;
				$observasi[$key] = $val;
			}

			$alatBantu = new AlatBantu;
			$alatBantu->kasus_id = $kasus->id;
			$alatBantu->type = "Observasi";
			$alatBantu->created_by = Auth::user()->id;
			$alatBantu->val = json_encode($observasi);
			$alatBantu->save();

			$status = 1;
			$message = 'Asesmen Observasi berhasil dibuat';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','alat-Observasi',$alatBantu->id);

			DB::connection('kasus')->commit();
			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		} catch (Exception $e) {
			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'Asesmen Observasi gagal dibuat!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
		
	}
}
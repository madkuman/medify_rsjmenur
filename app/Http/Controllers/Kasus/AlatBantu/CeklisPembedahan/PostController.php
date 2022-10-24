<?php

namespace App\Http\Controllers\Kasus\AlatBantu\CeklisPembedahan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatCeklisBedah;
use Auth;
use DB;

define('relasi', []);

class PostController extends Controller
{

	static protected $jumlah_all = 59;

	public function submit($nomor_kasus, Request $req)
	{	
		DB::connection('kasus')->beginTransaction();
		try {
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
			$content = [];
			$input = $req->all();
			$checked=0;
			foreach($input as $key => $val){
				if($key == '_token' || $key == 'id') continue;
				$content[$key] = $val;
				if(!empty($val))
					$checked++;
			}
			if($checked>self::$jumlah_all)
				$checked = self::$jumlah_all;

			if($req->id)
			{
				$res = $this->update($req->id, $kasus->id, $content, $checked);
			} else {
				$res = $this->create($kasus->id, $content, $checked);
			}

			DB::connection('kasus')->commit();
			return back()
			->with('message', $res['message'])
			->with('title',$res['title'])
			->with('status', $res['status']);
		} catch (Exception $e) {
			DB::connection('kasus')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$status = -1;
			$message = 'Asesmen Ceklis Bedah gagal!';
			$title = 'Error!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}		
	}

	public function create($kasus_id, $content, $checked)
	{
		$alatBantu = new AlatCeklisBedah;
		$alatBantu->kasus_id = $kasus_id;
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->val = json_encode($content);
		$alatBantu->presentase =  ($checked/self::$jumlah_all)*100;
		$alatBantu->save();

		$status = 1;
		$message = 'Asesmen Ceklis Bedah berhasil dibuat';
		$title = 'Berhasil!';

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus_id,'create','alat-Ceklis Bedah',$alatBantu->id);
		return [
			'status' => $status,
			'message' => $message,
			'title' => $title
		];
	}

	public function update($id, $kasus_id, $content, $checked)
	{
		$alatBantu = AlatCeklisBedah::find($id);
		$alatBantu->updated_by = Auth::user()->id;
		$alatBantu->val = json_encode($content);
		$alatBantu->presentase =  ($checked/self::$jumlah_all)*100;
		$alatBantu->save();

		$status = 1;
		$message = 'Asesmen Ceklis Bedah berhasil diupdate';
		$title = 'Berhasil!';

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus_id,'update','alat-Ceklis-Bedah',$alatBantu->id);
		return [
			'status' => $status,
			'message' => $message,
			'title' => $title
		];
	}

	public function delete($nomor_kasus, Request $req)
	{	
		try {
			$hemo = AlatCeklisBedah::find($req->id);
			$hemo->delete();

			$status = 1;
			$message = 'Asesmen Ceklis Bedah berhasil dihapus';
			$title = 'Berhasil!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		} catch (Exception $e) {
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'Asesmen Ceklis Bedah gagal dibuat!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}		
	}
}
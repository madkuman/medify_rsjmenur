<?php

namespace App\Http\Controllers\Kasus\AlatBantu\RehabMedik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use Auth;
use DB;

define('relasi', []);

class PostController extends Controller
{
	static protected $type = "Klinik Rehab Medik";

	public function submit($nomor_kasus, Request $req)
	{	
		DB::connection('kasus')->beginTransaction();
		try {
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$content = [];
			$input = $req->all();
			foreach($input as $key => $val){
				if($key == '_token' || $key == 'id_rehab' || $key == 'id_lanjutan') continue;
					$content[$key] = $val;
			}
			if($req->id_rehab){
				if($req->id_lanjutan)
				{
					$res = $this->updateLanjutan($req, $kasus->id, $content);
				}
				else
				{
					$res = $this->createLanjutan($req, $kasus->id, $content);
				}
			} else {
				if($req->id)
				{
					$res = $this->update($req->id, $kasus->id, $content);
				} else {
					$res = $this->create($kasus->id, $content);
				}
			}

			DB::connection('kasus')->commit();
			return back()
			->with('message', $res['message'])
			->with('title',$res['title'])
			->with('status', $res['status']);
		} catch (Exception $e) {
			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'Asesmen Klinik Rehab Medik gagal dibuat!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}		
	}

	public function create($kasus_id, $content)
	{
		$alat_bantu = new AlatBantu;
		$alat_bantu->kasus_id = $kasus_id;
		$alat_bantu->type = self::$type;
		$alat_bantu->created_by = Auth::user()->id;
		$alat_bantu->val = json_encode($content);
		$alat_bantu->save();

		$status = 1;
		$message = 'Asesmen Klinik Rehab Medik berhasil dibuat';
		$title = 'Berhasil!';

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus_id,'create','alat-Klinik Rehab Medik',$alat_bantu->id);
		return [
			'status' => $status,
			'message' => $message,
			'title' => $title
		];
	}

	public function update($id, $kasus_id, $content)
	{
		$alat_bantu = AlatBantu::find($id);
		$alat_bantu->type = self::$type;
		$alat_bantu->updated_by = Auth::user()->id;
		$alat_bantu->val = json_encode($content);
		$alat_bantu->save();

		$status = 1;
		$message = 'Asesmen Klinik Rehab Medik berhasil diupdate';
		$title = 'Berhasil!';

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus_id,'update','alat-Klinik Rehab Medik',$alat_bantu->id);
		return [
			'status' => $status,
			'message' => $message,
			'title' => $title
		];
	}

	public function createLanjutan($req, $kasus_id, $content)
	{
		$alat_bantu = AlatBantu::find($req->id_rehab);
		$old_content = json_decode($alat_bantu->val);
		if(isset($old_content->lanjutan)){
			// $new_id = count($old_content->lanjutan);
			// $content['id'] = $new_id;
			array_push($old_content->lanjutan, $content);
		} else {
			// $content['id'] = 0;
			$old_content->lanjutan = [$content];
		}

		$alat_bantu->val = json_encode($old_content);
		$alat_bantu->save();

		$status = 1;
		$message = 'Asesmen Lanjutan Rehab Medik berhasil dibuat';
		$title = 'Berhasil!';

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus_id,'create','alat-Klinik Lanjutan Rehab Medik',$alat_bantu->id);
		return [
			'status' => $status,
			'message' => $message,
			'title' => $title
		];
	}

	public function updateLanjutan($req, $kasus_id, $content)
	{
		$alat_bantu = AlatBantu::find($id);
		$alat_bantu->type = self::$type;
		$alat_bantu->updated_by = Auth::user()->id;
		$alat_bantu->val = json_encode($content);
		$alat_bantu->save();

		$status = 1;
		$message = 'Asesmen Lanjutan Rehab Medik berhasil diupdate';
		$title = 'Berhasil!';

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus_id,'update','alat-Klinik Lanjutan Rehab Medik',$alat_bantu->id);
		return [
			'status' => $status,
			'message' => $message,
			'title' => $title
		];
	}	

	public function delete($nomor_kasus, Request $req)
	{	
		try {
			$hemo = AlatBantu::find($req->id);
			$hemo->delete();

			$status = 1;
			$message = 'Asesmen Klinik Rehab Medik berhasil dihapus';
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
				$message = 'Asesmen Klinik Rehab Medik gagal dibuat!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}		
	}

}
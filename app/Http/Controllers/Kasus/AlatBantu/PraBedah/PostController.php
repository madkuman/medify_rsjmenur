<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PraBedah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use Auth;
use DB;

define('relasi', []);

class PostController extends Controller
{
	static protected $type = "pra-bedah";

	public function submit($nomor_kasus, Request $req)
	{	
		DB::connection('kasus')->beginTransaction();
		try {
			$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

			$content = [];
			$input = $req->all();
			foreach($input as $key => $val){
				if($key == '_token') continue;
				if($val == 'dijadwalkan'){
					if(isset($content['dijadwalkan']))
						array_push($content['dijadwalkan'], $key);
					else
						$content['dijadwalkan'] = [$key];
				} else {
					$content[$key] = $val;
				}
			}

			if($req->id)
			{
				$res = $this->update($req->id, $kasus->id, $content);
			} else {
				$res = $this->create($kasus->id, $content);
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
				$message = 'Asesmen Pra Bedah gagal dibuat!';
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
		$alatBantu = new AlatBantu;
		$alatBantu->kasus_id = $kasus_id;
		$alatBantu->type = self::$type;
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->val = json_encode($content);
		$alatBantu->save();

		$status = 1;
		$message = 'Asesmen Pra Bedah berhasil dibuat';
		$title = 'Berhasil!';

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus_id,'create','alat-pra-bedah',$alatBantu->id);
		return [
			'status' => $status,
			'message' => $message,
			'title' => $title
		];
	}

	public function update($id, $kasus_id, $content)
	{

		$alatBantu = AlatBantu::find($id);

		$alatBantuNew = new AlatBantu;
		$alatBantuNew->val = json_encode($content);
		$alatBantuNew->kasus_id = $alatBantu->kasus_id;
		$alatBantuNew->type = self::$type;
		$alatBantuNew->ref_id = $alatBantu->id;
		$alatBantuNew->updated_by = Auth::user()->id;
		$alatBantuNew->created_by = $alatBantu->created_by;
		$alatBantuNew->save();

		$alatBantu->delete();
		
		$status = 1;
		$message = 'Asesmen Pra Bedah berhasil diupdate';
		$title = 'Berhasil!';

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus_id,'update','alat-pra-bedah',$alatBantu->id);
		return [
			'status' => $status,
			'message' => $message,
			'title' => $title
		];
	}

	public function delete($nomor_kasus, Request $req)
	{	
		try {
			$alatBantu = AlatBantu::find($req->id);
			$alatBantu->deleted_by = Auth::user()->id;
			$alatBantu->delete();

			$status = 1;
			$message = 'Asesmen Pra Bedah berhasil dihapus';
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
				$message = 'Asesmen Pra Bedah gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}		
	}
}
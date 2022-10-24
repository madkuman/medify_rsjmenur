<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PengkajianAnestesi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use Auth;
use DB;

define('relasi', []);

class PostController extends Controller
{
	static protected $type = "Hemodialisis";

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
				$message = 'Asesmen Hemodialisis gagal dibuat!';
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
		$message = 'Asesmen Hemodialisis berhasil dibuat';
		$title = 'Berhasil!';

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus_id,'create','alat-Hemodialisis',$alatBantu->id);
		return [
			'status' => $status,
			'message' => $message,
			'title' => $title
		];
	}

	public function update($id, $kasus_id, $content)
	{
		$alatBantu = AlatBantu::find($id);
		$alatBantu->type = self::$type;
		$alatBantu->updated_by = Auth::user()->id;
		$alatBantu->val = json_encode($content);
		$alatBantu->save();

		$status = 1;
		$message = 'Asesmen Hemodialisis berhasil diupdate';
		$title = 'Berhasil!';

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus_id,'update','alat-Hemodialisis',$alatBantu->id);
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
			$message = 'Asesmen Hemodialisis berhasil dihapus';
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
				$message = 'Asesmen Hemodialisis gagal dibuat!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}		
	}
}
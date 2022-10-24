<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratKeterangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use App\User;
use Carbon\Carbon;
use Auth;
use DB;

define('relasi', []);

class PostController extends Controller
{
	static protected $type = "surat_keterangan";

	public function submit($nomor_kasus, Request $req)
	{
		DB::connection('kasus')->beginTransaction();
		try {
			$kasus = Kasus::with(relasi)->where('nomor_kasus', $nomor_kasus)->first();
			
			$content = [];
			$input = $req->all();
			
			foreach($input as $key => $val){
				if($key == '_token' || $key == 'id') continue;

				if (!is_null($val) && ($key == 'mulai_rawat_inap' || $key == 'selesai_rawat_inap' || $key == 'mulai_rawat_jalan' || $key == 'selesai_rawat_jalan' || $key == 'mulai_istirahat' || $key == '	selesai_istirahat')) {

					$content[$key] = Carbon::createFromFormat("d/m/Y", $val);
				}
				$content[$key] = $val;
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

			if(config('app.env') != 'production') {
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else {
				$status = -1;
				$message = 'Surat Keterangan Gagal Dibuat!';
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
		$message = 'Surat Keterangan Berhasil Dibuat';
		$title = 'Berhasil!';

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus_id,'create', 'surat-keterangan', $alatBantu->id);
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
		$alatBantu->updated_at = date('Y-m-d H:i:s');
		$alatBantu->val = json_encode($content);
		$alatBantu->save();

		$status = 1;
		$message = 'Surat Keterangan berhasil diupdate';
		$title = 'Berhasil!';

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus_id, 'update','surat-keterangan', $alatBantu->id);
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
			$message = 'Surat Keterangan Berhasil Dihapus';
			$title = 'Berhasil!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		} catch (Exception $e) {
			if(config('app.env') != 'production') {
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else {
				$status = -1;
				$message = 'Surat Keterangan Gagal Dibuat!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}		
	}
}
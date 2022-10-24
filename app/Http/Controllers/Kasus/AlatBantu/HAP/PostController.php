<?php

namespace App\Http\Controllers\Kasus\AlatBantu\HAP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;
use Auth;
use DB;

class PostController extends Controller
{
    
	public function create($nomor_kasus, Request $request)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		
		$input = $request->all();
		$count = 0;
		foreach($input as $key => $val){
			if($key == '_token') continue;
			if($key == 'lokasi_id') continue;
			$item[$key] = $val;
			if($val) $count++;
		}
		$item['skor'] = $count;


		$alatBantu = new AlatBantu;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->lokasi_id = $request->lokasi_id;
		$alatBantu->type = 'hap';
		$alatBantu->val = json_encode($item);
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->save();


		$status = 1;
		$message = 'Form HAP berhasil dibuat';
		$title = 'Berhasil!';

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-hap',$alatBantu->id);

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function delete($nomor_kasus, Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try
		{
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$id = $request->id;
			$psi = AlatBantu::find($id);
			$psi->delete();

			$status = 1;
			$message = 'Skor HAP berhasil dihapus!';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-isk',$psi->id);

			DB::connection('kasus')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
		catch (\Exception $e) {


			DB::connection('kasus')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			$status = -1;
			$message = 'Skor HAP gagal dihapus!';
			$title = 'Error!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}
}

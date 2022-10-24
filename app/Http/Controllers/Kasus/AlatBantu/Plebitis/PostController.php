<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Plebitis;

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
		$alatBantu->type = 'plebitis';
		$alatBantu->lokasi_id = $request->lokasi_id;
		$alatBantu->parent_id = $request->parent_id;
		$alatBantu->val = json_encode($item);
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->save();


		$status = 1;
		$message = 'Form Plebitis berhasil dibuat';
		$title = 'Berhasil!';

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-plebitis',$alatBantu->id);

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
			$message = 'Skor Plebitis berhasil dihapus!';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-plebitis',$psi->id);

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
			$message = 'Skor Plebitis gagal dihapus!';
			$title = 'Error!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}




	public function editMaster($nomor_kasus, Request $request)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$input = $request->all();
		$count = 0;
		if(!empty($input['jenis_cath_lain'])) $input['jenis_cath'] = '';
		if(!empty($input['jenis_cairan_lain'])) $input['jenis_cairan'] = '';

		foreach($input as $key => $val){
			if($key == '_token') continue;
			$plebitis[$key] = $val;
		}


		if(empty($request->id)) $master_plebitis = new AlatBantu;
		else $master_plebitis = AlatBantu::find($request->id);

		$master_plebitis->kasus_id = $kasus->id;
		$master_plebitis->type = 'master-plebitis';
		$master_plebitis->lokasi_id = $request->lokasi_id;
		$master_plebitis->val = json_encode($plebitis);
		$master_plebitis->created_by = Auth::user()->id;
		$master_plebitis->save();


		$status = 1;
		$message = 'Form Master Plebitis berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-master-plebitis',$master_plebitis->id);


		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}
}

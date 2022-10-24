<?php

namespace App\Http\Controllers\Kasus\AlatBantu\ISK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;
use Auth;

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
			$isk[$key] = $val;
			if($val) $count++;
		}
		$isk['skor'] = $count;


		$alatBantu = new AlatBantu;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->type = 'isk';
		$alatBantu->lokasi_id = $request->lokasi_id;
		$alatBantu->parent_id = $request->parent_id;
		$alatBantu->val = json_encode($isk);
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->save();


		$status = 1;
		$message = 'Form ISK berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-isk',$alatBantu->id);


		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function createAudit($nomor_kasus, Request $request)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		
		$input = $request->all();
		$count = 0;
		foreach($input as $key => $val){
			if($key == '_token') continue;
			if($key == 'lokasi_id') continue;
			$isk[$key] = $val;
			if($val) $count++;
		}
		$isk['skor'] = $count;


		$alatBantu = new AlatBantu;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->type = 'isk-audit';
		$alatBantu->lokasi_id = $request->lokasi_id;
		$alatBantu->val = json_encode($isk);
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->save();


		$status = 1;
		$message = 'Form Audit ISK berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-isk-audit',$alatBantu->id);


		return redirect('kasus/'.$nomor_kasus.'/alat-bantu/isk#tab-audit')
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}


	public function editMaster($nomor_kasus, Request $request)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$input = $request->all();
		$count = 0;
		if(!empty($input['jenis_cath_lain'])) $input['jenis_cath'] = '';
		if(!empty($input['nomor_cath_lain'])) $input['nomor_cath'] = '';

		foreach($input as $key => $val){
			if($key == '_token') continue;
			$isk[$key] = $val;
		}

		if(empty($request->id)) $master_isk = new AlatBantu;
		else $master_isk = AlatBantu::find($request->id);

		$master_isk->kasus_id = $kasus->id;
		$master_isk->type = 'master-isk';
		$master_isk->lokasi_id = $request->lokasi_id;
		$master_isk->val = json_encode($isk);
		$master_isk->created_by = Auth::user()->id;
		$master_isk->save();


		$status = 1;
		$message = 'Form ISK berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-master-isk',$master_isk->id);


		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}
}

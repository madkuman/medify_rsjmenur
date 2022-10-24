<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Surveilans;

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

		$surveilans = [];
		$input = $req->all();
		foreach($input as $key => $val){
			if($key == '_token' || $key == 'type') continue;
			if($key == 'lokasi_id') continue;
			if($val == 'on') $val = 1;
			$surveilans[$key] = $val;
		}
		$alatBantu = new AlatBantu;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->type = $req->type;
		$alatBantu->lokasi_id = $req->lokasi_id;
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->val = json_encode($surveilans);
		$alatBantu->save();


		$status = 1;
		$message = 'Asesmen '.$req->type.' berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-'.$req->type,$alatBantu->id);

		if($req->type == 'Surveilans Infeksi Luka Pre Ops') $hash = 'tab-pre';
		elseif($req->type == 'Surveilans Infeksi Luka Durante Ops') $hash = 'tab-durante';
		else $hash = 'tab-post';

		return redirect('kasus/'.$kasus->nomor_kasus.'/alat-bantu/surveilans#'.$hash)
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function edit($nomor_kasus, Request $req)
	{
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$surveilans = [];
		$input = $req->all();
		foreach($input as $key => $val){
			if($key == '_token' || $key == 'type') continue;
			if($key == 'lokasi_id') continue;
			if($val == 'on') $val = 1;
			$surveilans[$key] = $val;
		}
		$alatBantu = AlatBantu::find($req->id);
		$alatBantu->val = json_encode($surveilans);
		$alatBantu->save();


		$status = 1;
		$message = 'Asesmen '.$req->type.' berhasil diedit';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'edit','alat-'.$req->type,$alatBantu->id);

		if($req->type == 'Surveilans Infeksi Luka Pre Ops') $hash = 'tab-pre';
		elseif($req->type == 'Surveilans Infeksi Luka Durante Ops') $hash = 'tab-durante';
		else $hash = 'tab-post';

		return redirect('kasus/'.$kasus->nomor_kasus.'/alat-bantu/surveilans#'.$hash)
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
		$alatBantu->type = 'ido-audit';
		$alatBantu->lokasi_id = $request->lokasi_id;
		$alatBantu->val = json_encode($isk);
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->save();


		$status = 1;
		$message = 'Form Audit IDO berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-ido-audit',$alatBantu->id);

		$hash = 'tab-audit';
		return redirect('kasus/'.$kasus->nomor_kasus.'/alat-bantu/surveilans#'.$hash)
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function APIGetSurveilans($nomor_kasus,$id)
	{
		$alat = AlatBantu::find($id);
		$alat->val = json_decode($alat->val);
		return json_encode($alat);	
	}
}
<?php

namespace App\Http\Controllers\Kasus\AlatBantu\MonitoringVentilator;

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

		$monitoring = [];
		$input = $req->all();
		foreach($input as $key => $val){
			if($key == '_token') continue;
			if($key == 'lokasi_id') continue;
			$monitoring[$key] = $val;
		}

		$alatBantu = new AlatBantu;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->type = 'vap';
		$alatBantu->lokasi_id = $req->lokasi_id;
		$alatBantu->parent_id = $req->parent_id;
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->val = json_encode($monitoring);
		$alatBantu->save();


		$status = 1;
		$message = 'Asesmen Monitoring Ventilator berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-Monitoring Ventilator',$alatBantu->id);


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
		$alatBantu->type = 'vap-audit';
		$alatBantu->lokasi_id = $request->lokasi_id;
		$alatBantu->val = json_encode($isk);
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->save();


		$status = 1;
		$message = 'Form Audit VAP berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-vap-audit',$alatBantu->id);


		return redirect('kasus/'.$nomor_kasus.'/alat-bantu/monitoring-ventilator#tab-audit')
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function editMaster($nomor_kasus, Request $request)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$input = $request->all();
		$count = 0;

		foreach($input as $key => $val){
			if($key == '_token') continue;
			$isk[$key] = $val;
		}

		if(empty($request->id)) $master_vap = new AlatBantu;
		else $master_vap = AlatBantu::find($request->id);

		$master_vap->kasus_id = $kasus->id;
		$master_vap->type = 'master-vap';
		$master_vap->lokasi_id = $request->lokasi_id;
		$master_vap->val = json_encode($isk);
		$master_vap->created_by = Auth::user()->id;
		$master_vap->save();


		$status = 1;
		$message = 'Form VAP berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-master-vap',$master_vap->id);


		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}
}
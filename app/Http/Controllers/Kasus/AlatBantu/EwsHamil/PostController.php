<?php

namespace App\Http\Controllers\Kasus\AlatBantu\EwsHamil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use Auth;
use DB;


define('relasi', []);

class PostController extends Controller
{
	public function create($nomor_kasus,Request $request)
	{
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$respiratory = $request->input('respiratory');
		$spo2 = $request->input('spo2');
		$temp = $request->input('temp');
		$meternal = $request->input('meternal');
		$systol = $request->input('systol');
		$diastol = $request->input('diastol');
		$avpu = $request->input('avpu');

		$score = abs($respiratory) + abs($spo2) + abs($temp) + abs($meternal) + abs($systol)+ abs($diastol)+ abs($avpu);

		$ewsHamil = new \stdclass();
		$ewsHamil->respiratory = $request->input('respiratory');
		$ewsHamil->spo2 = $request->input('spo2');
		$ewsHamil->temp = $request->input('temp');
		$ewsHamil->maternal = $request->input('maternal');
		$ewsHamil->systol = $request->input('systol');
		$ewsHamil->diastol = $request->input('diastol');
		$ewsHamil->avpu = $request->input('avpu');
		$ewsHamil->score = $score;

		$alatBantu = new AlatBantu;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->type = "EWS Ibu Hamil";
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->val = json_encode($ewsHamil);
		$alatBantu->save();


		$status = 1;
		$message = 'nilai EWS Ibu Hamil berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-ewsHamil',$alatBantu->id);


		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}
}

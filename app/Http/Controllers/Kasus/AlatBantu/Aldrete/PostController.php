<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Aldrete;

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

		$warna = $request->input('warna');
		$pernafasan = $request->input('pernafasan');
		$sirkulasi = $request->input('sirkulasi');
		$kesadaran = $request->input('kesadaran');
		$aktifitas = $request->input('aktifitas');

		$score = abs($warna) + abs($pernafasan) + abs($sirkulasi) + abs($kesadaran) + abs($aktifitas);

		$aldrete = new \stdclass();
		$aldrete->warna = $request->input('warna');
		$aldrete->pernafasan = $request->input('pernafasan');
		$aldrete->sirkulasi = $request->input('sirkulasi');
		$aldrete->kesadaran = $request->input('kesadaran');
		$aldrete->aktifitas = $request->input('aktifitas');
		$aldrete->score = $score;

		$alatBantu = new AlatBantu;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->type = "Aldrete";
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->val = json_encode($aldrete);
		$alatBantu->save();


		$status = 1;
		$message = 'nilai Aldrete berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-aldrete',$alatBantu->id);


		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}
}

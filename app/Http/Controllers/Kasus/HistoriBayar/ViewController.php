<?php

namespace App\Http\Controllers\Kasus\HistoriBayar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Keuangan\Akun;

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$data['kasus'] = $kasus;
		$pasien_id = $kasus->pasien_id;
		$data['sidebar_active'] = 'tagihan';
		$data['active_nav'] = 'histori';
		$data['histori'] = app('App\Http\Controllers\Kasus\HistoriBayar\ReadController')->getHistori($kasus->id);
		$data['akun'] = Akun::all();
		//dd($data);

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'view','histori-bayar',null);
		
		$data['kasir'] = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getAll();

		return view('kasus.histori-bayar.index',$data);
	}
}

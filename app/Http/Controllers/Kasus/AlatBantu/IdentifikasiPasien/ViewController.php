<?php

namespace App\Http\Controllers\Kasus\AlatBantu\IdentifikasiPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$data['kasus'] = $kasus;
		$data['sidebar_active'] = 'alatbantu';

		$data['identifikasi'] = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)->where('type','identifikasi-pasien')->orderBy('id','desc')->get();
		return view('kasus.alatbantu.identifikasi-pasien.index',$data);
	}
}

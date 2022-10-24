<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Defekasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatDefekasi;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
		$data['kasus'] = $kasus;
		$defekasi = AlatDefekasi::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

		$data['defekasi'] = $defekasi;


   		$data['sidebar_active'] = 'alat';

		return view('kasus.alatbantu.defekasi.index',$data);
	}
}


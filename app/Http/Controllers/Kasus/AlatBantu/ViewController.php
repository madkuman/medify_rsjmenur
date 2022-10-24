<?php

namespace App\Http\Controllers\Kasus\AlatBantu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Log;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{

		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
		$data['kasus'] = $kasus;
   		$data['sidebar_active'] = 'alat';
		$data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();
		$data['riwayat'] = Log::with(['creator'])->where('kasus_id', $kasus->id)->where('tab', 'like', 'alat%')->whereIn('type', ['create', 'delete'])->orderBy('created_at', 'desc')->get();
		foreach($data['riwayat'] as $log)
		{
			$log_string = app('App\Http\Controllers\Kasus\Home\ViewController')->generateLogString($log);
			$log->tanggal = $log->tanggal;
			$log->tab_string = $log_string['tab'];
			$log->type_string = $log_string['type'];
			$log->icon = $log_string['icon'];
		}

   		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'view','alat-bantu',null);

		return view('kasus.alatbantu.index',$data);
	}

	public function mutu($nomor_kasus)
	{

		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
		$data['kasus'] = $kasus;
   		$data['sidebar_active'] = 'mutu';
   		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'view','alat-bantu',null);

		return view('kasus.mutu.index',$data);
	}

	public function ppi($nomor_kasus)
	{

		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
		$data['kasus'] = $kasus;
   		$data['sidebar_active'] = 'ppi';
   		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'view','alat-bantu',null);

		return view('kasus.ppi.index',$data);
	}
}

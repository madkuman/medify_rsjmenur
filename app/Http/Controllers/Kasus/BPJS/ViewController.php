<?php

namespace App\Http\Controllers\Kasus\BPJS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\BPJSSEP;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use DOMPDF;


define('relasi', ['lokasi', 'admin', 'identitas', 'pembayaran', 'pasien', 'kelas', 'myRole', 'myRoleWithoutEnd']);

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{
        ini_set('memory_limit', "1024M");
        ini_set('max_execution_time', "300");
		$kasus = Kasus::with(['lokasi', 'admin', 'identitas', 'pembayaran', 'pasien', 'kelas', 'myRole', 'myRoleWithoutEnd',  'bpjs.tagihan_detail.lokasi'])->where('nomor_kasus',$nomor_kasus)->first();
		$data['bpjs_sep_list'] = $kasus->bpjs;
		$data['kasus'] = $kasus;
		$data['sidebar_active'] = 'tagihan';
		$data['active_nav'] = 'bpjs';
		
		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'view','bpjs',null);
		return view('kasus.bpjs.index',$data);
	}

	public function print($nomor_kasus,$id)
	{	
		//dd($nomor_kasus,$id);
		$bpjs = BPJSSEP::where('id',$id)->first();
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
		//dd($bpjs,$kasus);
		$tanggal = Carbon::parse($bpjs->created_at)->format('d-m-Y');
		$tl = $kasus->identitas->tanggal_lahir;
		$tl = explode('-',$tl);
		$tl = array_reverse($tl);
		$tl = implode('-',$tl);
		//dd($tl);
		$customPaper = array(0,0,597,300);
		$pdf = DOMPDF::loadView('kasus.bpjs.print',['bpjs'=>$bpjs,'kasus'=>$kasus,'tanggal'=>$tanggal,'tl'=>$tl])->setPaper($customPaper);
		return $pdf->stream('print.pdf');
	}
}

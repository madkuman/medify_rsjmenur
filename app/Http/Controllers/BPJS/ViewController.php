<?php

namespace App\Http\Controllers\BPJS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\BPJSSEP;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\RujukLuar;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use DOMPDF;

class ViewController extends Controller
{
	public function index()
	{
		return view('bpjs.index');
	}

	public function printrujuk($id)
	{
		//dd($id);
		$data['rujuk'] = RujukLuar::where('id',$id)->first();
		//dd($data);
		$data['kasus'] = Kasus::where('nomor_kasus',$data['rujuk']->nomor_kasus)->first();
		$data['pasien'] = Pasien::where('id',$data['kasus']->pasien_id)->first();
		$data['bpjs'] = BPJSSEP::where('no_sep',$data['rujuk']->no_sep)->first();
		$data['tl'] = $data['pasien']->date_of_birth;
		$data['tl'] = explode('-',$data['tl']);
		$data['tl'] = array_reverse($data['tl']);
		$data['tl'] = implode('-',$data['tl']);
		$tanggal_berlaku = Carbon::now()->addDays(90)->format('Y-m-d');
		$rencana_berkunjung = Carbon::parse($data['rujuk']->rencana_berkunjung)->format('Y-m-d');
		$tanggal_rujuk = Carbon::parse($data['rujuk']->tanggal_rujuk)->format('Y-m-d');
		$data['tanggal_berlaku'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($tanggal_berlaku,'%d %B %Y');
		$data['rencana_berkunjung'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($rencana_berkunjung,'%d %B %Y');
		$data['tanggal_rujuk'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($tanggal_rujuk,'%d %B %Y');
		//dd($rujuk,$kasus);
		//dd($data);
		$customPaper = array(0,0,597,300);
		$pdf = DOMPDF::loadView('kasus.pengaturan.pdf.rujuk',$data)->setPaper($customPaper);
		return $pdf->stream('print.pdf');
	}
}
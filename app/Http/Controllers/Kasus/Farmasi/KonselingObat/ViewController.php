<?php

namespace App\Http\Controllers\Kasus\Farmasi\KonselingObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\RekonsiliasiObat;
use App\Models\Kasus\RekonsiliasiObatDetail;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Resep;
use DOMPDF;

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$data['konseling_obat'] = AlatBantu::where('type', 'farmasi-konseling-obat')->where('kasus_id', $kasus->id)->orderBy('created_at', 'asc')->get();
		$data['kasus'] = $kasus;
		$data['sidebar_active'] = 'farmasi';
		$data['active_nav'] = 'konseling-obat';
		return view('kasus.farmasi.konseling-obat',$data);
	}

	public function print($nomor_kasus)
	{
		$kasus =  Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$data['kasus'] = $kasus;
		$data['konseling_obat'] = AlatBantu::where('type', 'farmasi-konseling-obat')->where('kasus_id', $kasus->id)->orderBy('created_at', 'asc')->get();
		$pdf = DOMPDF::loadView('kasus.farmasi.print-konseling-obat',$data);
		return $pdf->stream('print.pdf');

	}
}

<?php

namespace App\Http\Controllers\Kasus\Farmasi\Rekonsiliasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
		$rekonsiliasi = RekonsiliasiObat::where('kasus_id',$kasus->id)->with('details','creator','updater')->get();
		$rekonsiliasi_awal_data = RekonsiliasiObat::where('kasus_id',$kasus->id)->where('jenis','awal')->first();
		if(!empty($rekonsiliasi_awal_data->id)) $rekonsiliasi_awal = $rekonsiliasi_awal_data->id;
		else $rekonsiliasi_awal = null;

		$resep = Resep::where('kasus_id',$kasus->id)->with('resepDetail')->get();
		$resep_pulang = Resep::where('kasus_id',$kasus->id)->where('jenis_resep','pulang')->with('resepDetail')->get();

		$data['reseps'] = $resep;
		$data['resep_pulang'] = $resep_pulang;
		$data['kasus'] = $kasus;
		$data['rekon'] = $rekonsiliasi;
		$data['rekonsiliasi_awal'] = $rekonsiliasi_awal;
		$data['sidebar_active'] = 'farmasi';
		$data['active_nav'] = 'rekonsiliasi';
		return view('kasus.farmasi.rekonsiliasi',$data);
	}

	public function print($nomor_kasus)
	{
		$data['kasus'] = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$data['rekonsiliasi'] = RekonsiliasiObat::where('kasus_id',$data['kasus']->id)->with('details','creator','updater')->get();
		$pdf = DOMPDF::loadView('kasus.farmasi.print-rekonsiliasi',$data);
		return $pdf->stream('print.pdf');

	}
}

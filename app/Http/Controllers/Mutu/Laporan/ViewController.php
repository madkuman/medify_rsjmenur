<?php

namespace App\Http\Controllers\Mutu\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DOMPDF;
use App\Models\Hospital\Lokasi;
use App\Models\Hospital\LokasiZonaPPI;
use App\Models\Kepegawaian\Kuisioner;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\Bangsal;
use App\User;

class ViewController extends Controller
{

	public function index()
	{
		return view('mutu.laporan.index');
	}
	
	public function unit($unit)
	{
		$lokasi = [];
		$bangsals = Bangsal::get();
		foreach ($bangsals as $key => $bangsal) {
			$ruangan_ids = Ruangan::where('bangsal_id',$bangsal->id)->pluck('lokasi_id')->toArray();
			$ruangan_ids_text = implode(',', $ruangan_ids);

			$temp = new \stdClass();
			$temp->nama = 'Ruangan - '. $bangsal->nama;
			$temp->id = $ruangan_ids_text;
			array_push($lokasi, $temp);
		} 

		$lokasi_rj_igd = Lokasi::whereIn('lokasi_departemen_id',[1,2])->orderBy('nama')->get();
		foreach($lokasi_rj_igd as $item)
		{
			$temp = new \stdClass();
			$temp->nama = $item->nama;
			$temp->id = $item->id;
			array_push($lokasi, $temp);
		}
		$data['lokasi'] = $lokasi;
		$data['zona'] = $this->getZonaPPI();
		$data['users'] = User::all();
		$data['kuisionerlist'] = Kuisioner::all();

		if ($unit == 'audit') {
			$data['penanggung_jawab'] = \App\Models\Kasus\MutuIdentifikasiResiko::pluck('penanggung_jawab')->unique();
			$data['penanggung_jawab_kegiatan'] = \App\Models\Kasus\MutuKegiatanPengendalian::pluck('penanggung_jawab')->unique();
		}

		$data['target_labpa'] = json_decode(app('App\Http\Controllers\LabPA\Laporan\ReadController')->getMaster('mutu-ketepatan')->konten);
		return view('mutu.laporan.unit.'.$unit, $data);
	}

	private function getZonaPPI()
	{
		$zona = LokasiZonaPPI::with('lokasi')->get();
		$zona_lokasi = [];
		foreach($zona as $item)
		{
			$lokasi_text = '';
			$lokasi =  $item->lokasi->pluck('id')->toArray();
			$lokasi_text = implode(",",$lokasi);
			$temp = new \stdClass();
			$temp->zona = $item->zona;
			$temp->value = $lokasi_text;
			$temp->lokasi = $item->deskripsi;
			array_push($zona_lokasi, $temp);
		}
		return $zona_lokasi;
	}

	public function pengumpulanDataReview()
	{
		$pdf = DOMPDF::loadView('mutu.laporan.pengumpulan-data-review')->setPaper('a4', 'landscape');
		return $pdf->stream('print.pdf');
	}

	public function checklistEdukasiStroke()
	{
		$pdf = DOMPDF::loadView('mutu.laporan.checklist-edukasi-stroke');
		return $pdf->stream('print.pdf');
	}

	public function pengaturanLabPA()
	{
		$data['master'] = app('App\Http\Controllers\LabPA\Laporan\ReadController')->getMaster('mutu-ketepatan');
		$data['konten'] = json_decode($data['master']->konten);
        $data['layanan'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getTarifFilter('lab-pa');
		return view('mutu.laporan.pengaturan.labpa', $data);
	}
}
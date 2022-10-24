<?php

namespace App\Http\Controllers\Mutu\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DOMPDF;
use App\Models\Hospital\Lokasi;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\Bangsal;
use App\User;

class ViewController extends Controller
{
	public function labPA()
	{
		$data['master'] = app('App\Http\Controllers\LabPA\Laporan\ReadController')->getMaster('mutu-ketepatan');
		$data['konten'] = json_decode($data['master']->konten);
        $data['layanan'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getTarifFilter('lab-pa');
		return view('mutu.laporan.pengaturan.labpa', $data);
	}
}
<?php

namespace App\Http\Controllers\Urikkes\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Kelas;

class ViewController extends Controller
{

	public function index(Request $request)
	{
		return view('urikkes/pengaturan/index');
	}

	public function dokter(Request $request)
	{
		$data['dokter'] = app('App\Http\Controllers\Urikkes\Pengaturan\ReadController')->getDokter();	
		return view('urikkes/pengaturan/dokter/index', $data);
	}

	public function paket(Request $request)
	{
		$data['paket'] = app('App\Http\Controllers\Urikkes\Pengaturan\ReadController')->getPaketWithLayanan();
		return view('urikkes/pengaturan/paket/index', $data);
	}


	public function detail(Request $request)
	{
		$data['paket'] = app('App\Http\Controllers\Urikkes\Pengaturan\ReadController')->getDetailPaket($request->paket_id);
		return view('urikkes/pengaturan/paket/detail', $data);
	}

	public function edit(Request $request)
	{
        $tarif_tipe = \App\Models\Keuangan\TarifTipe::pluck('id');
        $kls = Kelas::where('medical_checkup', 1)->first();
        $tarif_kelas[] = $kls->id;
        $tarif_kelas[] = "0";
		$data['paket'] = app('App\Http\Controllers\Urikkes\Pengaturan\ReadController')->getDetailPaket($request->paket_id);
        $data['tarif'] = app('App\Http\Controllers\Keuangan\Tarif\ReadController')->getTarifWithKelas($tarif_kelas, $tarif_tipe);
        return view('urikkes/pengaturan/paket/edit', $data);
	}

	public function tambah(Request $request)
	{
		$paket = new class{};
		$paket->nama = "";
		$paket->id = 0;
		$paket->layanan = [];
		$paket->tarifPaket = [];
		$kls = Kelas::where('medical_checkup', 1)->first();
		$tarif_tipe = \App\Models\Keuangan\TarifTipe::pluck('id');
		$tarif_kelas[] = $kls->id;
		$tarif_kelas[] = "0";
		$data['paket'] = $paket;
		$data['tarif'] = app('App\Http\Controllers\Keuangan\Tarif\ReadController')->getTarifWithKelas($tarif_kelas, $tarif_tipe);
		return view('urikkes/pengaturan/paket/edit', $data);
	}
}

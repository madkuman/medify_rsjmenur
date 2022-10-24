<?php

namespace App\Http\Controllers\RawatJalan\Pengaturan\Poliklinik;

use App\Models\RawatJalan\MasterTelekonsultasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\PoliklinikBpjs;
use App\Models\Hospital\Spesialisasi;
use App\Models\Hospital\MasterSIRSKunjunganKegiatan;

class ViewController extends Controller
{
	public function index()
	{
		$tarif = app('App\Http\Controllers\Keuangan\Tarif\ReadController')->getTarifRawatJalanKonsultasiDokter();
		$poli = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getPoli();
		$poli =  json_decode($poli);
		$data['poli'] = $poli->data;

		$data['tarif'] = $tarif;
		return view('rawatjalan.pengaturan.index',$data);
	}

	public function new()
	{
		$tarif = app('App\Http\Controllers\Keuangan\Tarif\ReadController')->getTarifRawatJalanKonsultasiDokter();
        $tarif_telekonsultasi = app('App\Http\Controllers\Keuangan\Tarif\ReadController')->getTarifByKategoriSlug(['telekonsultasi']);
        $data['poliklinik_bpjs']= PoliklinikBpjs::all();
        $data['spesialis']= Spesialisasi::all();
        $data['all_sirs_kunjungan_kegiatan'] = MasterSIRSKunjunganKegiatan::get();
        $data['tarif'] = $tarif;
        $data['tarif_telekonsultasi'] = $tarif_telekonsultasi;
		return view('rawatjalan.pengaturan.new',$data);
	}

	public function edit($id)
	{
		$tarif = app('App\Http\Controllers\Keuangan\Tarif\ReadController')->getTarifRawatJalanKonsultasiDokter();
        $tarif_telekonsultasi = app('App\Http\Controllers\Keuangan\Tarif\ReadController')->getTarifByKategoriSlug(['telekonsultasi']);
		$poli = app('App\Http\Controllers\RawatJalan\Poliklinik\ReadController')->get($id);
		$data['poli'] = $poli;
		$data['tarif'] = $tarif;
		$data['poliklinik_bpjs']= PoliklinikBpjs::all();
		$data['spesialis']= Spesialisasi::all();
		$data['all_sirs_kunjungan_kegiatan'] = MasterSIRSKunjunganKegiatan::get();
        $data['tarif_telekonsultasi'] = $tarif_telekonsultasi;
        $data['master_telekonsultasi'] = MasterTelekonsultasi::where('poliklinik_id',$id)->get();
		return view('rawatjalan.pengaturan.edit',$data);
	}
}

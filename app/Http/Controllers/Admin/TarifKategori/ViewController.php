<?php

namespace App\Http\Controllers\Admin\TarifKategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifKategoriSlug;
use App\Models\Hospital\MasterSIRSKegiatanRadiologi;
use App\Models\Hospital\MasterSIRSKegiatanLab;
use App\Models\Hospital\MasterSIRSKegiatanPerinatologi;
use App\Models\Hospital\MasterSIRSKegiatanGigiMulut;
use App\Models\Hospital\MasterSIRSKegiatanRehabMedik;
use App\Models\Hospital\MasterSIRSKegiatanPelayananKhusus;
use App\Models\Hospital\MasterSIRSKegiatanKesehatanJiwa;

class ViewController extends Controller
{
	public function index(Request $request)
	{
		$data['kategori'] = TarifKategori::get();
		$data['sidebar_active'] = "tarif";
		return view('admin.tarif-kategori.index', $data);
	}

	public function create()
	{
		$data['sidebar_active'] = "tarif";
		$data['kategori'] = TarifKategori::get();
		$data['slugs'] = TarifKategoriSlug::get();
		$data['jenis_kegiatan_radiologi'] = MasterSIRSKegiatanRadiologi::get();
		$data['jenis_kegiatan_lab'] = MasterSIRSKegiatanLab::get();
		$data['jenis_kegiatan_perinatologi'] = MasterSIRSKegiatanPerinatologi::get();
		$data['jenis_kegiatan_gigi_mulut'] = MasterSIRSKegiatanGigiMulut::get();
		$data['jenis_kegiatan_rehab_medik'] = MasterSIRSKegiatanRehabMedik::get();
		$data['jenis_kegiatan_pelayanan_khusus'] = MasterSIRSKegiatanPelayananKhusus::get();
		$data['jenis_kegiatan_kesehatan_jiwa'] = MasterSIRSKegiatanKesehatanJiwa::get();
		return view('admin.tarif-kategori.create', $data);
	}

	public function edit($id)
	{
		$data['kategori'] = TarifKategori::find($id);
		$data['sidebar_active'] = "tarif";
		$data['all_kategori'] = TarifKategori::get();
		$data['slugs'] = TarifKategoriSlug::get();
		$data['all_jenis_kegiatan_radiologi'] = MasterSIRSKegiatanRadiologi::get();
		$data['all_jenis_kegiatan_lab'] = MasterSIRSKegiatanLab::get();
		$data['all_jenis_kegiatan_perinatologi'] = MasterSIRSKegiatanPerinatologi::get();
		$data['all_jenis_kegiatan_gigi_mulut'] = MasterSIRSKegiatanGigiMulut::get();
		$data['all_jenis_kegiatan_rehab_medik'] = MasterSIRSKegiatanRehabMedik::get();
		$data['all_jenis_kegiatan_pelayanan_khusus'] = MasterSIRSKegiatanPelayananKhusus::get();
		$data['all_jenis_kegiatan_kesehatan_jiwa'] = MasterSIRSKegiatanKesehatanJiwa::get();
		return view('admin.tarif-kategori.edit', $data);
	}
}

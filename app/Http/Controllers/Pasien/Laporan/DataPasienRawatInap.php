<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Lokasi;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\ICD10;
use App\Models\Kasus\Kolaborator;
use App\Models\RawatInap\LaporanTransaksi;
use App\Models\Pasien\Pasien;
use Carbon\Carbon;


class DataPasienRawatInap extends Controller
{
	public function get($start,$end)
	{
		$transaksi = LaporanTransaksi::whereBetween('krs_at',[$start,$end])->orderBy('krs_at','asc')
		->with('pasien.tni_satker','pasien_pembayaran.perusahaan','kasus.lokasi.lokasi','kasus.identitas',
			'tempat_tidur.ruangan.bangsal','kasus.kelas','kasus.lokasi_first.lokasi','kasus.diagnosis.icd10','kasus.admin.user','kasus.sep')->get();
			
		return $transaksi;
		
	}

	private function getMasukDari($transaksi_awal)
	{
		$time = $transaksi_awal->waktu_masuk->subMinute();
		$lokasi = Lokasi::where('kasus_id',$transaksi_awal->kasus_id)->where('created_at','<',$time)->OrderBy('created_at','desc')->first();
		if(empty($lokasi->id)) $lokasi = Lokasi::where('kasus_id',$transaksi_awal->kasus_id)->first();
		return $lokasi->lokasi->nama;
	}

	private function getDPJP($kasus_id)
	{
		$kasus = Kasus::find($kasus_id);
		$kolab = $kasus->admin;
		if(empty($kolab->user)) $dpjp = '-';
		else $dpjp = $kolab->user->name;
		return $dpjp;
	}

	private function getDiagnosa($kasus_id)
	{
		$ids = Diagnosis::where('kasus_id',$kasus_id)->pluck('icd_10');
		$icd = ICD10::whereIn('id',$ids)->get();
		$items = $icd->pluck('long_desc')->toArray();
		$items = implode(", ",$items);
		return $items;
	}
}

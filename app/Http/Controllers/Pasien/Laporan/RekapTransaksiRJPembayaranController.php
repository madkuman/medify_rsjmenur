<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\LaporanTransaksi as LaporanTransaksiRawatJalan;
use App\Models\Pasien\PembayaranPerusahaan;


class RekapTransaksiRJPembayaranController extends Controller
{
	public function get($start, $end)
	{
		$perusahaan = PembayaranPerusahaan::get();
		foreach($perusahaan as $pt)
		{
			$pt->transaksi_rj = LaporanTransaksiRawatJalan::whereBetween('waktu_pemeriksaan',[$start,$end])
			->where('perusahaan_pembayaran_id',$pt->id)
			->with('kasus.pasien.alamat_kota','poliklinik','kasus.diagnosisUtama.icd10',
			'kasus.diagnosis.icd10','kasus.kelas','kasus.identitas','kasus.daftar_tagihan')
			->orderBy('perusahaan_pembayaran_id')->get();
		}
		return $perusahaan;
	}
}

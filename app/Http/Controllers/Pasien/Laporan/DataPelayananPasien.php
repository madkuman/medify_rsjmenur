<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Transaksi as RanapTransaksi;
use App\Models\RawatJalan\Transaksi as RajalTransaksi;
use App\Models\IGD\Transaksi as IgdTransaksi;
use App\Models\Urikkes\Transaksi as UrikkesTransaksi;
use Carbon\Carbon;

class DataPelayananPasien extends Controller
{
    public function get($date_start, $date_end, $jenis = 'Rawat Inap')
    {
    	if ($jenis == 'Rawat Inap') {
    		$data = RanapTransaksi::with('pasien', 'pasien.agama', 'pasien.pendidikan', 'pasien.tni_keanggotaan', 'pasien.tni_kotama', 'pasien.tni_satker', 'pasien.tni_pangkat', 'pasien.wali', 'pasien.jenis_hubungan_keluarga', 'kasus', 'kasus.sep', 'kasus.pembayaran', 'kasus.pembayaran.perusahaan', 'kasus.pembayaran.kelas', 'kasus.identitas', 'kasus.lokasi.lokasi', 'kasus.diagnosis', 'kasus.diagnosisUtama', 'kasus.diagnosis.icd10', 'kasus.diagnosisUtama.icd10', 'kasus.tindakan_icd9', 'kasus.tindakan_icd9.icd9')->whereBetween('waktu_masuk', [$date_start,$date_end])->get();
    	}elseif ($jenis == 'IGD'){
    	    $data = IgdTransaksi::with('pasien', 'pasien.agama', 'pasien.pendidikan', 'pasien.tni_keanggotaan', 'pasien.tni_kotama', 'pasien.tni_satker', 'pasien.tni_pangkat', 'pasien.wali', 'pasien.jenis_hubungan_keluarga', 'kasus', 'kasus.sep', 'kasus.pembayaran', 'kasus.pembayaran.perusahaan', 'kasus.pembayaran.kelas', 'kasus.identitas', 'kasus.lokasi.lokasi', 'kasus.diagnosis', 'kasus.diagnosisUtama', 'kasus.diagnosis.icd10', 'kasus.diagnosisUtama.icd10', 'kasus.tindakan_icd9', 'kasus.tindakan_icd9.icd9','ruangan')->whereBetween('waktu_masuk', [$date_start,$date_end])->get();
        }elseif ($jenis == 'MCU'){
            $data = UrikkesTransaksi::with('pasien', 'pasien.agama', 'pasien.pendidikan', 'pasien.tni_keanggotaan', 'pasien.tni_kotama', 'pasien.tni_satker', 'pasien.tni_pangkat', 'pasien.wali', 'pasien.jenis_hubungan_keluarga', 'kasus', 'kasus.sep', 'kasus.pembayaran', 'kasus.pembayaran.perusahaan', 'kasus.pembayaran.kelas', 'kasus.identitas', 'kasus.lokasi.lokasi', 'kasus.diagnosis', 'kasus.diagnosisUtama', 'kasus.diagnosis.icd10', 'kasus.diagnosisUtama.icd10', 'kasus.tindakan_icd9', 'kasus.tindakan_icd9.icd9','transaksi_detail.paket')->whereBetween('waktu_pemeriksaan', [$date_start,$date_end])->get();
        } else {
    		$data = RajalTransaksi::with('pasien', 'pasien.agama', 'pasien.pendidikan', 'pasien.tni_keanggotaan', 'pasien.tni_kotama', 'pasien.tni_satker', 'pasien.tni_pangkat', 'pasien.wali', 'pasien.jenis_hubungan_keluarga', 'kasus', 'kasus.sep', 'kasus.pembayaran', 'kasus.pembayaran.perusahaan', 'kasus.pembayaran.kelas', 'kasus.identitas', 'kasus.lokasi.lokasi', 'kasus.diagnosis', 'kasus.diagnosisUtama', 'kasus.diagnosis.icd10', 'kasus.diagnosisUtama.icd10', 'kasus.tindakan_icd9', 'kasus.tindakan_icd9.icd9')->whereBetween('waktu_pemeriksaan', [$date_start,$date_end])->get();
    	}
    	$result['data'] = $data;
    	$result['date_start'] = $date_start;
    	$result['date_end'] = $date_end;
    	return $result;
    }
}

<?php

namespace App\Http\Controllers\Pasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisAgama;
use App\Models\Pasien\JenisHubunganKeluarga;
use App\Models\Pasien\JenisKartuIdentitas;
use App\Models\Pasien\JenisKelamin;
use App\Models\Hospital\Kelas;
use App\Models\Pasien\JenisPendidikan;
use App\Models\Pasien\JenisPernikahan;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Pasien\PembayaranPerusahaanType;
use App\Models\Pasien\TNIKeanggotaan;
use App\Models\Pasien\TNIKotama;
use App\Models\Pasien\TNIPangkat;
use App\Models\Pasien\TNISatker;
use App\Models\Pasien\JenisPekerjaan;
use App\Models\Pasien\TNIKorps;

class Functions extends Controller
{
    	public function getAllForm()
    	{
    		$data['form']['agama'] = JenisAgama::all();
    		$data['form']['kelamin'] = JenisKelamin::all();
    		$data['form']['kelas'] = Kelas::all();
            $data['form']['hubungan_keluarga'] = JenisHubunganKeluarga::all();
            $data['form']['kartu_identitas'] = JenisKartuIdentitas::all();
    		$data['form']['jenis_pasien'] = PembayaranPerusahaanType::all();
    		$data['form']['pendidikan'] = JenisPendidikan::all();
    		$data['form']['pernikahan'] = JenisPernikahan::all();
            $data['form']['perusahaan'] = PembayaranPerusahaan::all();
    		$data['form']['tni_keanggotaan'] = TNIKeanggotaan::all();
    		$data['form']['tni_kotama'] = TNIKotama::all();
    		$data['form']['tni_pangkat'] = TNIPangkat::all();
    		$data['form']['tni_satker'] = TNISatker::all();
            $data['form']['jenis_pekerjaan'] = JenisPekerjaan::all();
            $data['form']['tni_korps'] = TNIKorps::all();

    		return $data;
    	}

}

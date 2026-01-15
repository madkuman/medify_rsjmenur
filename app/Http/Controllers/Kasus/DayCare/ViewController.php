<?php

namespace App\Http\Controllers\Kasus\DayCare;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\PemeriksaanPsikologiVisum;
use App\Models\Kasus\PsikogramVisum;
use App\Models\Kasus\TesIq;
use App\Models\Kasus\TesIqKeswara;
use App\Models\Kasus\LaporanPsikogramPemeriksaanPsikologi;
use App\Models\Kasus\LaporanDeskripsiPemeriksaanPsikologi;
use App\Models\Kasus\IdentifikasiPotensiPsikologi;
use App\Models\Kasus\BakatMinatAnak;
use App\Models\Kasus\BakatMinatDewasa;
use App\User;

define('relasi', ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus', $nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $data['sidebar_active'] = 'daycare';
        $data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();
        return view('kasus.daycare.index', $data);
    }
}
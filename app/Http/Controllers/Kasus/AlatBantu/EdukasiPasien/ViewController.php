<?php

namespace App\Http\Controllers\Kasus\AlatBantu\EdukasiPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatEdukasiPasien;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $edukasi_pasien = AlatEdukasiPasien::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();
        $data['edukasi_pasien'] = $edukasi_pasien;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.edukasi-pasien.index',$data);
    }
}

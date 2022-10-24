<?php

namespace App\Http\Controllers\Kasus\AlatBantu\CeklisPembedahan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatCeklisBedah;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $ceklis = AlatCeklisBedah::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

        $data['ceklis'] = $ceklis;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.ceklis-pembedahan.index', $data);
    }
}

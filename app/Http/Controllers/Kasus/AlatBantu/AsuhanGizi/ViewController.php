<?php

namespace App\Http\Controllers\Kasus\AlatBantu\AsuhanGizi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $asuhan_gizi = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)
        		->where('type', 'Asuhan Gizi')->orderBy('id','desc')->get();

        $data['asuhan_gizi'] = $asuhan_gizi;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.asuhan-gizi.index', $data);
    }
}

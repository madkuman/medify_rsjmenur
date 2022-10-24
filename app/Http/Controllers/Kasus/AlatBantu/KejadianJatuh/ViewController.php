<?php

namespace App\Http\Controllers\Kasus\AlatBantu\KejadianJatuh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatKejadianJatuh;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    static protected $type = "kejadian-jatuh";

    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $jatuh = AlatKejadianJatuh::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

        $data['jatuh'] = $jatuh;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.kejadian-jatuh.index', $data);
    }
}

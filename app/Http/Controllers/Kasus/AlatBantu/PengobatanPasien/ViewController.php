<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PengobatanPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;


define('relasi', []);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $pengobatan = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)
        		->where('type', 'Pengobatan Pasien')->orderBy('id','desc')->get();

        $data['pengobatan'] = $pengobatan;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.pengobatan-pasien.index', $data);
    }
}

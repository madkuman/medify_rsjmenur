<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PengkajianRanapMedikal;

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
        $ranap_medikal = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)
        		->where('type', 'Pengkajian Awal Ranap - Medikal Bedah')->orderBy('id','desc')->get();

        $data['ranap_medikal'] = $ranap_medikal;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.pengkajian-ranap-medikal.index', $data);
    }
}

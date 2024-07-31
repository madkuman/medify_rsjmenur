<?php

namespace App\Http\Controllers\Farmasi\MasterBahanAktif;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index($farmasi_slug)
    {
        $master_bahan_aktif = app('App\Http\Controllers\Farmasi\MasterBahanAktif\ReadController')->getAll();
        $data['sidebar_active'] = "master_bahan_aktif";
        $data['master_bahan_aktif'] = $master_bahan_aktif;
        return view('farmasi.master_bahan_aktif.index',$data);
    }

    public function single($farmasi_slug, $id)
    {
        $master_bahan_aktif = app('App\Http\Controllers\Farmasi\MasterBahanAktif\ReadController')->getSingle($id);
        $data['sidebar_active'] = "master_bahan_aktif";
        $data['master_bahan_aktif'] = $master_bahan_aktif;
        return view('farmasi.master_bahan_aktif.detail', $data);
    }

}
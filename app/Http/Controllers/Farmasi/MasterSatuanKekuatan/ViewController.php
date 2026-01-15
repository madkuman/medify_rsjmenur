<?php

namespace App\Http\Controllers\Farmasi\MasterSatuanKekuatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index($farmasi_slug)
    {
        $master_satuan_kekuatan = app('App\Http\Controllers\Farmasi\MasterSatuanKekuatan\ReadController')->getAll();
        $data['sidebar_active'] = "master_satuan_kekuatan";
        $data['master_satuan_kekuatan'] = $master_satuan_kekuatan;
        return view('farmasi.master_satuan_kekuatan.index',$data);
    }

    public function single($farmasi_slug, $id)
    {
        $master_satuan_kekuatan = app('App\Http\Controllers\Farmasi\MasterSatuanKekuatan\ReadController')->getSingle($id);
        $data['sidebar_active'] = "master_satuan_kekuatan";
        $data['satuan_kekuatan'] = $master_satuan_kekuatan;
        return view('farmasi.master_satuan_kekuatan.detail', $data);
    }

}
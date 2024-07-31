<?php

namespace App\Http\Controllers\Farmasi\MasterJenisInteraksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index($farmasi_slug)
    {
        $master_jenis_interaksi = app('App\Http\Controllers\Farmasi\MasterJenisInteraksi\ReadController')->getAll();
        $data['sidebar_active'] = "master_jenis_interaksi";
        $data['master_jenis_interaksi'] = $master_jenis_interaksi;
        return view('farmasi.master-jenis-interaksi.index',$data);
    }

    public function single($farmasi_slug, $id)
    {
        $master_jenis_interaksi = app('App\Http\Controllers\Farmasi\MasterJenisInteraksi\ReadController')->getSingle($id);
        $data['sidebar_active'] = "master_jenis_interaksi";
        $data['master_jenis_interaksi'] = $master_jenis_interaksi;
        return view('farmasi.master-jenis-interaksi.detail', $data);
    }

}
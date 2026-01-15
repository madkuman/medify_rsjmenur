<?php

namespace App\Http\Controllers\Farmasi\MasterRakObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index($farmasi_slug)
    {
        $master_rak_obat = app('App\Http\Controllers\Farmasi\MasterRakObat\ReadController')->getAll();
        $data['sidebar_active'] = "master_rak_obat";
        $data['master_rak_obat'] = $master_rak_obat;
        return view('farmasi.master-rak-obat.index',$data);
    }

    public function single($farmasi_slug, $id)
    {
        $master_rak_obat = app('App\Http\Controllers\Farmasi\MasterRakObat\ReadController')->getSingle($id);
        $data['sidebar_active'] = "master_rak_obat";
        $data['master_rak_obat'] = $master_rak_obat;
        return view('farmasi.master-rak-obat.detail', $data);
    }
}

<?php

namespace App\Http\Controllers\Farmasi\MasterRute;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index($farmasi_slug)
    {
        $rute = app('App\Http\Controllers\Farmasi\MasterRute\ReadController')->getAll();
        $data['sidebar_active'] = "master_rute";
        $data['rute'] = $rute;
        return view('farmasi.master-rute.index',$data);
    }

    public function single($farmasi_slug, $id)
    {
        $rute = app('App\Http\Controllers\Farmasi\MasterRute\ReadController')->getSingle($id);
        $data['sidebar_active'] = "master_rute";
        $data['rute'] = $rute;
        return view('farmasi.master-rute.detail', $data);
    }

}
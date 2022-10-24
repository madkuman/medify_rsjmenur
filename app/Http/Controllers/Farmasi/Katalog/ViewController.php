<?php

namespace App\Http\Controllers\Farmasi\Katalog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index($farmasi_slug)
    {
        $farmasi = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi_slug);
        $katalog = app('App\Http\Controllers\Farmasi\Katalog\ReadController')->getAll();
        $data['sidebar_active'] = "katalog";
        $data['katalog'] = $katalog;
        $data['farmasi'] = $farmasi;
        return view('farmasi.katalog.index',$data);
    }

    public function single($farmasi_slug, $id)
    {
        $farmasi = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi_slug);
        $katalog = app('App\Http\Controllers\Farmasi\Katalog\ReadController')->getSingle($id);
        $data['sidebar_active'] = "katalog";
        $data['farmasi'] = $farmasi;
        $data['katalog'] = $katalog;
        return view('farmasi.katalog.detail', $data);
    }

}
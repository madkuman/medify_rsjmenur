<?php

namespace App\Http\Controllers\Farmasi\SumberDana;

use App\Models\Farmasi\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index($farmasi_slug)
    {
        $farmasi = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi_slug);
        $sumber_dana = app('App\Http\Controllers\Farmasi\SumberDana\ReadController')->getAll();
        $kategori = Kategori::all();
        $data['sidebar_active'] = "sumber_dana";
        $data['sumber_dana'] = $sumber_dana;
        $data['farmasi'] = $farmasi;
        $data['kategori'] = $kategori;
        return view('farmasi.sumber-dana.index',$data);
    }

    public function single($farmasi_slug, $id)
    {
        $farmasi = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi_slug);
        $sumber_dana = app('App\Http\Controllers\Farmasi\SumberDana\ReadController')->getSingle($id);
        $kategori = Kategori::all();
        $data['sidebar_active'] = "sumber_dana";
        $data['farmasi'] = $farmasi;
        $data['sumber_dana'] = $sumber_dana;
        $data['kategori'] = $kategori;
        return view('farmasi.sumber-dana.detail', $data);
    }

}
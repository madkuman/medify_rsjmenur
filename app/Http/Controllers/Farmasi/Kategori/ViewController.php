<?php

namespace App\Http\Controllers\Farmasi\Kategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index($farmasi_slug)
    {
        $farmasi = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi_slug);
        $kategori = app('App\Http\Controllers\Farmasi\Kategori\ReadController')->getAll();
        $data['sidebar_active'] = "kategori";
        $data['kategori'] = $kategori;
        $data['farmasi'] = $farmasi;
        $data['lokasi'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasi();
        return view('farmasi.kategori.index',$data);
    }

    public function single($farmasi_slug, $slug)
    {
        $farmasi = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi_slug);
        $kategori = app('App\Http\Controllers\Farmasi\Kategori\ReadController')->getSingle($slug);
        $item_template_ids = $kategori->item->pluck('item_template_id')->toArray();
        $obat = app('App\Http\Controllers\Farmasi\Items\ReadController')->getItembyItemTemplateIds($item_template_ids,$farmasi);
        $data['sidebar_active'] = "";
        $data['farmasi'] = $farmasi;
        $data['kategori'] = $kategori;
        $data['obat'] = $obat;
        $data['lokasi'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasi();
        return view('farmasi.kategori.detail', $data);
    }

}
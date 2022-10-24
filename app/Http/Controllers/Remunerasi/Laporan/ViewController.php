<?php

namespace App\Http\Controllers\Remunerasi\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ViewController extends Controller
{
    // PAGE
	public function index() {
        $data['sidebar_active'] = 'laporan';
        $data['kategori_pegawai'] = app('App\Http\Controllers\Kepegawaian\MasterKategoriPegawai\ReadController')->getAll();
        return view('remunerasi.laporan.index', $data);
    }

}
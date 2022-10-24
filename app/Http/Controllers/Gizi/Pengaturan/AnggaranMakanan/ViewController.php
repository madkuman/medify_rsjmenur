<?php

namespace App\Http\Controllers\Gizi\Pengaturan\AnggaranMakanan;

use App\Models\Hospital\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        $data['status'] = 'pengaturan';
        $data['jenis_makanan'] = app('App\Http\Controllers\Gizi\Pengaturan\JenisMakanan\ReadController')->getAll();
        $data['kelas'] = Kelas::all();
        $data['bangsal'] = app('App\Http\Controllers\RawatInap\Bangsal\ReadController')->allBangsal();
        return view('gizi.pengaturan.content.anggaran-makanan.index',$data);
    }

    public function detail($id)
    {
        $data['status'] = 'pengaturan';
        $data['anggaran_makanan'] = app('App\Http\Controllers\Gizi\Pengaturan\AnggaranMakanan\ReadController')->single($id);
        $data['jenis_makanan'] = app('App\Http\Controllers\Gizi\Pengaturan\JenisMakanan\ReadController')->getAll();
        $data['kelas'] = Kelas::all();
        $data['bangsal'] = app('App\Http\Controllers\RawatInap\Bangsal\ReadController')->allBangsal();
        return view('gizi.pengaturan.content.anggaran-makanan.detail',$data);
    }
}

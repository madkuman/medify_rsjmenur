<?php

namespace App\Http\Controllers\Gizi\Pengaturan\JenisMakanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        $data['status'] = 'pengaturan';
        return view('gizi.pengaturan.content.jenis-makanan.index',$data);
    }
}

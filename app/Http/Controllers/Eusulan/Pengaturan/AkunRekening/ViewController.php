<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\AkunRekening;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = 'pengaturan';
        return view('eusulan.pengaturan.akun-rekening.index',$data);
    }
}

<?php

namespace App\Http\Controllers\Farmasi\PenghapusanJenis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\PenghapusanJenis;

class ViewController extends Controller
{
    public function index()
    {
        $data['penghapusan_jenis'] = PenghapusanJenis::get();
        $data['sidebar_active'] = "";
        return view('farmasi.penghapusan-jenis.index',$data);
    }
}

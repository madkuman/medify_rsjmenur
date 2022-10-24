<?php

namespace App\Http\Controllers\Eusulan\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = 'laporan';
        $data['unit'] = app('App\Http\Controllers\Eusulan\Pengaturan\Unit\ReadController')->get();
        return view('eusulan.laporan.index',$data);
    }
}

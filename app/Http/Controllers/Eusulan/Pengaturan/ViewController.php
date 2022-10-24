<?php

namespace App\Http\Controllers\Eusulan\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = 'pengaturan';
        return view('eusulan.pengaturan.index',$data);
    }
}

<?php

namespace App\Http\Controllers\Gizi\Pengaturan\Diet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        $data['status'] = 'pengaturan';
        return view('gizi.pengaturan.content.diet.index',$data);
    }
}

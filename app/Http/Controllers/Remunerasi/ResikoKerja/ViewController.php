<?php

namespace App\Http\Controllers\Remunerasi\ResikoKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ViewController extends Controller
{
    // PAGE
	public function index() {
        $data['sidebar_active'] = 'resiko-kerja';
        return view('remunerasi.resiko-kerja.index', $data);
    }

}
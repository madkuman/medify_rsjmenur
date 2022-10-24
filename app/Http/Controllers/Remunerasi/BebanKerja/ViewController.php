<?php

namespace App\Http\Controllers\Remunerasi\BebanKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ViewController extends Controller
{
    // PAGE
	public function index() {
        $data['sidebar_active'] = 'beban-kerja';
        return view('remunerasi.beban-kerja.index', $data);
    }

}
<?php

namespace App\Http\Controllers\Remunerasi\Absensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ViewController extends Controller
{
    // PAGE
	public function index() {
        $data['sidebar_active'] = 'absensi';
        return view('remunerasi.absensi.index', $data);
    }

    public function create() {
        $data['sidebar_active'] = 'absensi';
        return view('remunerasi.absensi.create', $data);
    }

}
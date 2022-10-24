<?php

namespace App\Http\Controllers\Remunerasi\Keuangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ViewController extends Controller
{
    // PAGE
	public function index() {
        $data['sidebar_active'] = 'keuangan';
        return view('remunerasi.keuangan.index', $data);
    }

    public function create() {
        $data['sidebar_active'] = 'keuangan';
        return view('remunerasi.keuangan.create', $data);
    }

}
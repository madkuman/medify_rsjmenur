<?php

namespace App\Http\Controllers\Remunerasi\Pajak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ViewController extends Controller
{
    // PAGE
	public function index() {
        $data['sidebar_active'] = 'pajak';
        return view('remunerasi.pajak.index', $data);
    }

}
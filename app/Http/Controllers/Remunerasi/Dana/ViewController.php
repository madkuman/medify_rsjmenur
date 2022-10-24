<?php

namespace App\Http\Controllers\Remunerasi\Dana;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ViewController extends Controller
{
    // PAGE
	public function index() {
        $data['sidebar_active'] = 'dana';
        return view('remunerasi.dana.index', $data);
    }

}
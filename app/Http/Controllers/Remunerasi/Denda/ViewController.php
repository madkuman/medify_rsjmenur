<?php

namespace App\Http\Controllers\Remunerasi\Denda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ViewController extends Controller
{
    // PAGE
	public function index() {
        $data['sidebar_active'] = 'denda';
        return view('remunerasi.denda.index', $data);
    }

    public function create() {
        $data['sidebar_active'] = 'denda';
        return view('remunerasi.denda.create', $data);
    }

}
<?php

namespace App\Http\Controllers\Remunerasi\MasterIndex;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ViewController extends Controller
{
    // PAGE
	public function index() {
        $data['sidebar_active'] = 'master-index';
        return view('remunerasi.master-index.index', $data);
    }

}
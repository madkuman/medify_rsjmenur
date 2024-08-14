<?php

namespace App\Http\Controllers\BPJS\Monitoring\Antrean;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        return view('bpjs.antrean.index');
    }
}

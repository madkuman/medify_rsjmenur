<?php

namespace App\Http\Controllers\Humas\Komplain;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        $data['komplain'] =  app('App\Http\Controllers\Humas\Komplain\ReadController')->getKomplainAll();
		return view('humas.index', $data);
    }
}

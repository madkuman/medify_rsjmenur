<?php

namespace App\Http\Controllers\Urikkes\Layanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index(Request $request)
	{
		$data['layanan'] = app('App\Http\Controllers\Urikkes\Layanan\ReadController')->getAllLayanan();
		return view('urikkes/layanan/index', $data);
	}
}

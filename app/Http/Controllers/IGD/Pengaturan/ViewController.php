<?php

namespace App\Http\Controllers\IGD\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Ruangan;

class ViewController extends Controller
{
	public function index()
	{
		$data['ruangan'] = Ruangan::all();
		return view('igd.pengaturan.index', $data);
	}

	public function new()
	{
		return view('igd.pengaturan.new');
	}

	public function edit($id)
	{
		$data['ruangan'] = Ruangan::find($id);
		return view('igd.pengaturan.edit', $data);
	}
}

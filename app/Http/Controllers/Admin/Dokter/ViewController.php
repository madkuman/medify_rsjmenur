<?php

namespace App\Http\Controllers\Admin\Dokter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Dokter;
use App\User;

class ViewController extends Controller
{
	public function index(Request $request)
	{
		$data['dokter'] = Dokter::with('jadwal.poli', 'user')->get();
		$data['sidebar_active'] = "tarif";
		return view('admin.dokter.index', $data);
	}

	public function create()
	{
		$data['sidebar_active'] = "tarif";
		$data['user'] = User::where('profesi', 1)->get();
		$data['poliklinik'] = app('App\Http\Controllers\RawatJalan\Poliklinik\ReadController')->allPoliPrint();
		return view('admin.dokter.create', $data);
	}

	public function edit($id)
	{
		$data['dokter'] = Dokter::find($id);
		$data['sidebar_active'] = "tarif";
		$data['user'] = User::where('profesi', 1)->get();
		$data['poliklinik'] = app('App\Http\Controllers\RawatJalan\Poliklinik\ReadController')->allPoliPrint();
		return view('admin.dokter.edit', $data);
	}
}

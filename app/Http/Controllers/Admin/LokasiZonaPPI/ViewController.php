<?php

namespace App\Http\Controllers\Admin\LokasiZonaPPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\LokasiZonaPPI;


class ViewController extends Controller
{
	public function index()
	{	
		$data = LokasiZonaPPI::get();
		return view('admin.lokasi-zona-ppi.index',['data'=>$data]);
	}

	public function create()
	{
		return view('admin.lokasi-zona-ppi.create');
	}

	public function edit($id)
	{
		$data['data'] = LokasiZonaPPI::where('id',$id)->first();
		return view('admin.lokasi-zona-ppi.create',$data);
	}
}

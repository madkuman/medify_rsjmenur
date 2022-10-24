<?php

namespace App\Http\Controllers\LabPK\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Form;

class ViewController extends Controller
{
	public function index()
	{	
		$data['data'] = Form::all();
		$data['header'] = "pengaturan";
		return view('labpk.form.index',$data);
	}

	public function create()
	{
		$data['header'] = "pengaturan";
		return view('labpk.form.create',$data);
	}

	public function edit($id)
	{
		$data['form'] = Form::where('id',$id)->with('detail')->first();
		$data['header'] = "pengaturan";
		return view('labpk.form.edit',$data);
	}
}

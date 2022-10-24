<?php

namespace App\Http\Controllers\Admin\Kelas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Kelas;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = Kelas::all();
    	return view('admin.kelas.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.kelas.create');
    }

    public function edit($id)
    {
    	$data = Kelas::where('id',$id)->first();
    	return view('admin.kelas.create',['data'=>$data]);
    }
}

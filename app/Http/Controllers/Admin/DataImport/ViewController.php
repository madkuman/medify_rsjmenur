<?php

namespace App\Http\Controllers\Admin\DataImport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\DataImport;


class ViewController extends Controller
{
    public function index()
    {
    	$data = DataImport::orderBy('id','desc')->get();
    	return view('admin.data-import.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.data-import.baru');
    }
}

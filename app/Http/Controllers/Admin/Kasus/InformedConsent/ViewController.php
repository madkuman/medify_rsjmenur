<?php

namespace App\Http\Controllers\Admin\Kasus\InformedConsent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\InformedConsent;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = InformedConsent::all();
    	return view('admin.kasus.informed-consent.index',['data'=>$data]);
    }

    public function create()
    {
        $data=[];
    	return view('admin.kasus.informed-consent.create',['data'=>$data]);
    }

    public function edit($id)
    {
    	$data = InformedConsent::where('id',$id)->first();
    	return view('admin.kasus.informed-consent.create',['data'=>$data]);
    }
}

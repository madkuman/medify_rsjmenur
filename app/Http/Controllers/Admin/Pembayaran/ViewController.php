<?php

namespace App\Http\Controllers\Admin\Pembayaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisPembayaran;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = JenisPembayaran::all();
    	return view('admin.pembayaran.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.pembayaran.create');
    }

    public function edit($id)
    {
    	$data = JenisPembayaran::where('id',$id)->first();
    	return view('admin.pembayaran.create',['data'=>$data]);
    }
}
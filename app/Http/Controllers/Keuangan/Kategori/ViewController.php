<?php

namespace App\Http\Controllers\Keuangan\Kategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;

class ViewController extends Controller
{
    public function index()
    {	
    	$sidebar_active = 'pengaturan';
    	//$data = app
    	return view('keuangan.kategori.index',['sidebar_active'=>$sidebar_active]);
    }

    public function new()
    {
    	$sidebar_active = 'pengaturan';
    	$kategori = Kategori::all();
    	return view('keuangan.kategori.add',['kategori'=>$kategori,'sidebar_active'=>$sidebar_active]);
    }

    public function single($id)
    {	
    	$nama = 0;
    	$data = Kategori::where('id',$id)->first();
    	$sidebar_active = 'pengaturan';
    	if($data->parent_id != 0)
    	{
    		$nama = app('App\Http\Controllers\Keuangan\Kategori\ReadController')->getNama($data->parent_id);
    	}
    	//dd($nama);
    	return view('keuangan.kategori.single',['data'=>$data,'sidebar_active'=>$sidebar_active, 'nama'=>$nama]);
    }

    public function edit($id)
    {
    	$data = Kategori::where('id',$id)->first();
    	$sidebar_active = 'pengaturan';
    	$kategori = Kategori::all();
    	if($data->parent_id != 0)
    	{
    		$nama = Kategori::where('id',$data->parent_id)->first();
    	}
        else $nama = '';

    	return view('keuangan.kategori.add',['kategori'=>$kategori,'sidebar_active'=>$sidebar_active,'data'=>$data,'nama'=>$nama]);
    }
}

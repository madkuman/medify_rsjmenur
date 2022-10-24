<?php

namespace App\Http\Controllers\Keuangan\Rekanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Perusahaan;

class ViewController extends Controller
{
    public function index()
    {	
    	$sidebar_active = 'pengaturan';
    	//$data = app
    	return view('keuangan.rekanan.index',['sidebar_active'=>$sidebar_active]);
    }

    public function new()
    {
    	$sidebar_active = 'pengaturan';
    	// $rekanan = Rekanan::all();
    	return view('keuangan.rekanan.add',['sidebar_active'=>$sidebar_active]);
    }

    public function edit($id)
    {
        $data['sidebar_active'] = 'pengaturan';
        $data['rekanan'] = Perusahaan::find($id);
        return view('keuangan.rekanan.edit', $data);
    }

    // public function single($id)
    // {	
    // 	$nama = 0;
    // 	$data = Rekanan::where('id',$id)->first();
    // 	$sidebar_active = 'pengaturan';
    // 	if($data->parent_id != 0)
    // 	{
    // 		$nama = app('App\Http\Controllers\Keuangan\Rekanan\ReadController')->getNama($data->parent_id);
    // 	}
    // 	//dd($nama);
    // 	return view('keuangan.rekanan.single',['data'=>$data,'sidebar_active'=>$sidebar_active, 'nama'=>$nama]);
    // }

    // public function edit($id)
    // {
    // 	$data = Rekanan::where('id',$id)->first();
    // 	$sidebar_active = 'pengaturan';
    // 	$rekanan = Rekanan::all();
    // 	if($data->parent_id != 0)
    // 	{
    // 		$nama = Rekanan::where('id',$data->parent_id)->first();
    // 	}

    // 	return view('keuangan.rekanan.add',['rekanan'=>$rekanan,'sidebar_active'=>$sidebar_active,'data'=>$data,'nama'=>$nama]);
    // }
}

<?php

namespace App\Http\Controllers\Admin\SirsKegiatanKesehatanJiwa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function edit($id,$data)
    {
    	$pendidikan = app('App\Http\Controllers\Admin\SirsKegiatanKesehatanJiwa\ReadController')->getById($id);
    	$pendidikan->nomor = $data['nomor'];
    	$pendidikan->nama = $data['nama'];
    	$pendidikan->save();

    	return $pendidikan;
    }	
}

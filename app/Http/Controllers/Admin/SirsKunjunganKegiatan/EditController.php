<?php

namespace App\Http\Controllers\Admin\SirsKunjunganKegiatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function edit($id,$data)
    {
    	$pendidikan = app('App\Http\Controllers\Admin\SirsKunjunganKegiatan\ReadController')->getById($id);
    	$pendidikan->nama = $data['nama'];
    	$pendidikan->save();

    	return $pendidikan;
    }	
}

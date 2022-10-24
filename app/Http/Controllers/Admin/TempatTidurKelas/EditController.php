<?php

namespace App\Http\Controllers\Admin\TempatTidurKelas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function edit($id,$data)
    {
    	$pendidikan = app('App\Http\Controllers\Admin\TempatTidurKelas\ReadController')->getById($id);
    	$pendidikan->nama = $data['nama'];
    	$pendidikan->save();

    	return $pendidikan;
    }	
}

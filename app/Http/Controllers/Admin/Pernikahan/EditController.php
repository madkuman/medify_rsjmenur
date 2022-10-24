<?php

namespace App\Http\Controllers\Admin\Pernikahan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisPernikahan;

class EditController extends Controller
{
    public function edit($id,$data)
    {
    	$pernikahan = JenisPernikahan::where('id',$id)->first();
    	$pernikahan->nama = $data['nama'];
    	$pernikahan->created_by = $data['pegawai'];
    	$pernikahan->save();

    	return $pernikahan;
    }
}

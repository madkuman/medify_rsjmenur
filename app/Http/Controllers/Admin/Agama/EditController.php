<?php

namespace App\Http\Controllers\Admin\Agama;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisAgama;

class EditController extends Controller
{
    public function edit($id,$data)
    {
    	$agama = JenisAgama::Where('id',$id)->first();
    	$agama->nama = $data['nama'];
    	$agama->created_by = $data['pegawai'];
    	$agama->save();

    	return $agama;
    }	
}

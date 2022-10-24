<?php

namespace App\Http\Controllers\Admin\Identitas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisKartuIdentitas;

class EditController extends Controller
{
    public function edit($id,$data)
    {
    	$identitas = JenisKartuIdentitas::Where('id',$id)->first();
    	$identitas->nama = $data['nama'];
    	$identitas->created_by = $data['pegawai'];
    	$identitas->save();

    	return $identitas;
    }
}

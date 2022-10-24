<?php

namespace App\Http\Controllers\Admin\Keluarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisHubunganKeluarga;

class EditController extends Controller
{
    public function edit($id,$data)
    {
    	$keluarga = JenisHubunganKeluarga::where('id',$id)->first();
    	$keluarga->nama = $data['nama'];
    	$keluarga->created_by = $data['pegawai'];
    	$keluarga->save();

    	return $keluarga;
    }
}

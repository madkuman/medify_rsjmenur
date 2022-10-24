<?php

namespace App\Http\Controllers\Admin\Keluarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisHubunganKeluarga;

class CreateController extends Controller
{
    public function create($data)
    {
    	$keluarga = new JenisHubunganKeluarga;
    	$keluarga->nama = $data['nama'];
    	$keluarga->created_by = $data['pegawai'];
    	$keluarga->save();

    	return $keluarga;
    }
}

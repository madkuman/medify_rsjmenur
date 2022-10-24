<?php

namespace App\Http\Controllers\Admin\Agama;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisAgama;

class CreateController extends Controller
{
    public function create($data)
    {
    	$agama = new JenisAgama;
    	$agama->nama = $data['nama'];
    	$agama->created_by = $data['pegawai'];
    	$agama->save();

    	return $agama;
    }
}

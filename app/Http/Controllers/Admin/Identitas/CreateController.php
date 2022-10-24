<?php

namespace App\Http\Controllers\Admin\Identitas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisKartuIdentitas;

class CreateController extends Controller
{
    public function create($data)
    {
    	$identitas = new JenisKartuIdentitas;
    	$identitas->nama = $data['nama'];
    	$identitas->created_by = $data['pegawai'];
    	$identitas->save();

    	return $identitas;
    }
}

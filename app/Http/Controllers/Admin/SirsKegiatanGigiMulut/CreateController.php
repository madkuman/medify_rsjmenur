<?php

namespace App\Http\Controllers\Admin\SirsKegiatanGigiMulut;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSKegiatanGigiMulut;

class CreateController extends Controller
{
    public function create($data)
    {
    	$pendidikan = new MasterSIRSKegiatanGigiMulut;
    	$pendidikan->nomor = $data['nomor'];
    	$pendidikan->nama = $data['nama'];
    	$pendidikan->save();

    	return $pendidikan;
    }
}

<?php

namespace App\Http\Controllers\Admin\SirsKegiatanRadiologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSKegiatanRadiologi;

class CreateController extends Controller
{
    public function create($data)
    {
    	$pendidikan = new MasterSIRSKegiatanRadiologi;
    	$pendidikan->nomor = $data['nomor'];
    	$pendidikan->nama = $data['nama'];
    	$pendidikan->save();

    	return $pendidikan;
    }
}

<?php

namespace App\Http\Controllers\Admin\SirsKegiatanLab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSKegiatanLab;

class CreateController extends Controller
{
    public function create($data)
    {
    	$pendidikan = new MasterSIRSKegiatanLab;
    	$pendidikan->nomor = $data['nomor'];
    	$pendidikan->nama = $data['nama'];
    	$pendidikan->save();

    	return $pendidikan;
    }
}

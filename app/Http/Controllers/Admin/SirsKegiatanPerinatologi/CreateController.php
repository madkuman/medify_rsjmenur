<?php

namespace App\Http\Controllers\Admin\SirsKegiatanPerinatologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSKegiatanPerinatologi;

class CreateController extends Controller
{
    public function create($data)
    {
    	$pendidikan = new MasterSIRSKegiatanPerinatologi;
    	$pendidikan->nomor = $data['nomor'];
    	$pendidikan->nama = $data['nama'];
    	$pendidikan->save();

    	return $pendidikan;
    }
}

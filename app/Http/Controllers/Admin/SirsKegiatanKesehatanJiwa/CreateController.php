<?php

namespace App\Http\Controllers\Admin\SirsKegiatanKesehatanJiwa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSKegiatanKesehatanJiwa;

class CreateController extends Controller
{
    public function create($data)
    {
    	$pendidikan = new MasterSIRSKegiatanKesehatanJiwa;
    	$pendidikan->nomor = $data['nomor'];
    	$pendidikan->nama = $data['nama'];
    	$pendidikan->save();

    	return $pendidikan;
    }
}

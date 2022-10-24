<?php

namespace App\Http\Controllers\Admin\SirsCaraBayar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSCaraBayar;

class CreateController extends Controller
{
    public function create($data)
    {
    	$pendidikan = new MasterSIRSCaraBayar;
    	$pendidikan->nomor = $data['nomor'];
    	$pendidikan->nama = $data['nama'];
    	$pendidikan->save();

    	return $pendidikan;
    }
}

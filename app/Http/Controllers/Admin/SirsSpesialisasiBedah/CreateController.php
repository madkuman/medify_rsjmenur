<?php

namespace App\Http\Controllers\Admin\SirsSpesialisasiBedah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSSpesialisasiBedah;

class CreateController extends Controller
{
    public function create($data)
    {
    	$pendidikan = new MasterSIRSSpesialisasiBedah;
    	$pendidikan->nama = $data['nama'];
    	$pendidikan->save();

    	return $pendidikan;
    }
}

<?php

namespace App\Http\Controllers\Admin\SirsKunjunganKegiatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSKunjunganKegiatan;

class CreateController extends Controller
{
    public function create($data)
    {
    	$pendidikan = new MasterSIRSKunjunganKegiatan;
    	$pendidikan->nama = $data['nama'];
    	$pendidikan->save();

    	return $pendidikan;
    }
}

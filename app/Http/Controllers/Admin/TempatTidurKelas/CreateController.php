<?php

namespace App\Http\Controllers\Admin\TempatTidurKelas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSTempatTidurKelas;

class CreateController extends Controller
{
    public function create($data)
    {
    	$pendidikan = new MasterSIRSTempatTidurKelas;
    	$pendidikan->nama = $data['nama'];
    	$pendidikan->save();

    	return $pendidikan;
    }
}

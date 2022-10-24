<?php

namespace App\Http\Controllers\Admin\TempatTidurJenis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSTempatTidurJenis;

class CreateController extends Controller
{
    public function create($data)
    {
    	$pendidikan = new MasterSIRSTempatTidurJenis;
    	$pendidikan->nama = $data['nama'];
    	$pendidikan->save();

    	return $pendidikan;
    }
}

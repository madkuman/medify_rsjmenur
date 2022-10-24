<?php

namespace App\Http\Controllers\Admin\SirsSpesialisasiRujukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSSpesialisasiRujukan;

class ReadController extends Controller
{
    public function getAll()
    {
        return MasterSIRSSpesialisasiRujukan::all();
    }

    public function getById($id)
    {
        return MasterSIRSSpesialisasiRujukan::where('id',$id)->first();
    }
}

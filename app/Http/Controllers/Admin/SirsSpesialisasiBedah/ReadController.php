<?php

namespace App\Http\Controllers\Admin\SirsSpesialisasiBedah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSSpesialisasiBedah;

class ReadController extends Controller
{
    public function getAll()
    {
        return MasterSIRSSpesialisasiBedah::all();
    }

    public function getById($id)
    {
        return MasterSIRSSpesialisasiBedah::where('id',$id)->first();
    }
}

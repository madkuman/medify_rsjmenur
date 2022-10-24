<?php

namespace App\Http\Controllers\Admin\SirsKegiatanRadiologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSKegiatanRadiologi;

class ReadController extends Controller
{
    public function getAll()
    {
        return MasterSIRSKegiatanRadiologi::all();
    }

    public function getById($id)
    {
        return MasterSIRSKegiatanRadiologi::where('id',$id)->first();
    }
}

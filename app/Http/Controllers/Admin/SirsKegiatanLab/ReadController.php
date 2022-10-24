<?php

namespace App\Http\Controllers\Admin\SirsKegiatanLab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSKegiatanLab;

class ReadController extends Controller
{
    public function getAll()
    {
        return MasterSIRSKegiatanLab::all();
    }

    public function getById($id)
    {
        return MasterSIRSKegiatanLab::where('id',$id)->first();
    }
}

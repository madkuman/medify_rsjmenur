<?php

namespace App\Http\Controllers\Admin\SirsKegiatanPerinatologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSKegiatanPerinatologi;

class ReadController extends Controller
{
    public function getAll()
    {
        return MasterSIRSKegiatanPerinatologi::all();
    }

    public function getById($id)
    {
        return MasterSIRSKegiatanPerinatologi::where('id',$id)->first();
    }
}

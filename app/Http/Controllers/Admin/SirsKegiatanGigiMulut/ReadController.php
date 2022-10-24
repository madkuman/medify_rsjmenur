<?php

namespace App\Http\Controllers\Admin\SirsKegiatanGigiMulut;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSKegiatanGigiMulut;

class ReadController extends Controller
{
    public function getAll()
    {
        return MasterSIRSKegiatanGigiMulut::all();
    }

    public function getById($id)
    {
        return MasterSIRSKegiatanGigiMulut::where('id',$id)->first();
    }
}

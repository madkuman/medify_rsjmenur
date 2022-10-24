<?php

namespace App\Http\Controllers\Admin\SirsKegiatanPelayananKhusus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSKegiatanPelayananKhusus;

class ReadController extends Controller
{
    public function getAll()
    {
        return MasterSIRSKegiatanPelayananKhusus::all();
    }

    public function getById($id)
    {
        return MasterSIRSKegiatanPelayananKhusus::where('id',$id)->first();
    }
}

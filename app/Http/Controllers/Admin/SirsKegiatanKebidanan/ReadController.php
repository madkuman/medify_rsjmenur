<?php

namespace App\Http\Controllers\Admin\SirsKegiatanKebidanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSKegiatanKebidanan;

class ReadController extends Controller
{
    public function getAll()
    {
        return MasterSIRSKegiatanKebidanan::all();
    }

    public function getById($id)
    {
        return MasterSIRSKegiatanKebidanan::where('id',$id)->first();
    }
}

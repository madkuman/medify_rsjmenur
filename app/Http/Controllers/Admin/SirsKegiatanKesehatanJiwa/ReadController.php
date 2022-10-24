<?php

namespace App\Http\Controllers\Admin\SirsKegiatanKesehatanJiwa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSKegiatanKesehatanJiwa;

class ReadController extends Controller
{
    public function getAll()
    {
        return MasterSIRSKegiatanKesehatanJiwa::all();
    }

    public function getById($id)
    {
        return MasterSIRSKegiatanKesehatanJiwa::where('id',$id)->first();
    }
}

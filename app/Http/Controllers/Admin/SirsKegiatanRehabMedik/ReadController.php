<?php

namespace App\Http\Controllers\Admin\SirsKegiatanRehabMedik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSKegiatanRehabMedik;

class ReadController extends Controller
{
    public function getAll()
    {
        return MasterSIRSKegiatanRehabMedik::all();
    }

    public function getById($id)
    {
        return MasterSIRSKegiatanRehabMedik::where('id',$id)->first();
    }
}

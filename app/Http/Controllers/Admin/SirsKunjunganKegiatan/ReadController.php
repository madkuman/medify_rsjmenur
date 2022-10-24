<?php

namespace App\Http\Controllers\Admin\SirsKunjunganKegiatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSKunjunganKegiatan;

class ReadController extends Controller
{
    public function getAll()
    {
        return MasterSIRSKunjunganKegiatan::all();
    }

    public function getById($id)
    {
        return MasterSIRSKunjunganKegiatan::where('id',$id)->first();
    }
}

<?php

namespace App\Http\Controllers\Admin\SirsCaraBayar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSCaraBayar;

class ReadController extends Controller
{
    public function getAll()
    {
        return MasterSIRSCaraBayar::all();
    }

    public function getById($id)
    {
        return MasterSIRSCaraBayar::where('id',$id)->first();
    }
}

<?php

namespace App\Http\Controllers\Admin\TempatTidurKelas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSTempatTidurKelas;

class ReadController extends Controller
{
    public function getAll()
    {
        return MasterSIRSTempatTidurKelas::all();
    }

    public function getById($id)
    {
        return MasterSIRSTempatTidurKelas::where('id',$id)->first();
    }
}

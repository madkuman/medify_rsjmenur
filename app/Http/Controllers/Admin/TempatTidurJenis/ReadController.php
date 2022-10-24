<?php

namespace App\Http\Controllers\Admin\TempatTidurJenis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSTempatTidurJenis;

class ReadController extends Controller
{
    public function getAll()
    {
        return MasterSIRSTempatTidurJenis::all();
    }

    public function getById($id)
    {
        return MasterSIRSTempatTidurJenis::where('id',$id)->first();
    }
}

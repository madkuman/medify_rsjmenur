<?php

namespace App\Http\Controllers\Kepegawaian\MasterResikoKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterResikoKerja;
use DB;

class ReadController extends Controller
{
    public function getAllResiko()
    {
        $resiko = MasterResikoKerja::all();
        return $resiko;
    }
}

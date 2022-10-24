<?php

namespace App\Http\Controllers\Kepegawaian\MasterBebanKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterBebanKerja;
use DB;

class ReadController extends Controller
{
    public function getAllBeban()
    {
        $beban = MasterBebanKerja::all();
        return $beban;
    }
}

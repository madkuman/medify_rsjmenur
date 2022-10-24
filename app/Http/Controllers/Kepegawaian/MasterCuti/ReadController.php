<?php

namespace App\Http\Controllers\Kepegawaian\MasterCuti;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterCuti;

class ReadController extends Controller
{
    public function getAll()
    {
        $cuti = MasterCuti::all();
        return $cuti;
    }
}

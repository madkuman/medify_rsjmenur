<?php

namespace App\Http\Controllers\Kepegawaian\MasterJabatanIntern;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJabatanIntern;

class ReadController extends Controller
{
    public function getData()
    {
        $master = new MasterJabatanIntern;
        return $master;
    }
}

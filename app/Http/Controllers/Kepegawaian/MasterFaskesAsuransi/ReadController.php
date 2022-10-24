<?php

namespace App\Http\Controllers\Kepegawaian\MasterFaskesAsuransi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterFaskesAsuransi;

class ReadController extends Controller
{
    public function getData()
    {
        $data = new MasterFaskesAsuransi;
        return $data;
    }
}

<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisSuratPeringatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisSuratPeringatan;

class ReadController extends Controller
{
    public function getData()
    {
        $data = new MasterJenisSuratPeringatan;
       return $data;
    }
}

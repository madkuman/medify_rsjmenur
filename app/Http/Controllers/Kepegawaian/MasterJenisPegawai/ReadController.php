<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisPegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisPegawai;

class ReadController extends Controller
{
    public function getData()
    {
        $data = new MasterJenisPegawai;
       return $data;
    }
}

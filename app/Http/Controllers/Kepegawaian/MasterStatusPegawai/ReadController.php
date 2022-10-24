<?php

namespace App\Http\Controllers\Kepegawaian\MasterStatusPegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterStatusPegawai;

class ReadController extends Controller
{
    public function getData()
    {
       $data = new MasterStatusPegawai;
       return $data;
    }
}

<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisKendaraan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisKendaraan;

class ReadController extends Controller
{
    public function getData()
    {
       $data = new MasterJenisKendaraan;
       return $data;
    }
}

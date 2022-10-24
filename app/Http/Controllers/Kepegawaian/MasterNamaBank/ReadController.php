<?php

namespace App\Http\Controllers\Kepegawaian\MasterNamaBank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterNamaBank;

class ReadController extends Controller
{
    public function getData()
    {
       $data = new MasterNamaBank;
       return $data;
    }
}

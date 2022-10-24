<?php

namespace App\Http\Controllers\Kepegawaian\MasterStatusRumah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterStatusRumah;

class ReadController extends Controller
{
    public function getData()
    {
       $data = new MasterStatusRumah;
       return $data;
    }
}

<?php

namespace App\Http\Controllers\Kepegawaian\MasterKualifikasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterKualifikasi;

class ReadController extends Controller
{
    public function getData()
    {
        $master = new MasterKualifikasi;
        return $master;
    }
}

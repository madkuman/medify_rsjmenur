<?php

namespace App\Http\Controllers\Kepegawaian\MasterSubkualifikasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterSubkualifikasi;
use App\Models\Kepegawaian\MasterKualifikasi;

class ReadController extends Controller
{
    public function getData()
    {
        return $subkualifikasi = new MasterSubkualifikasi;
    }
}

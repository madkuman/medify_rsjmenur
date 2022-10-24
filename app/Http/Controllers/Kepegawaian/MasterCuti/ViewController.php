<?php

namespace App\Http\Controllers\Kepegawaian\MasterCuti;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        $data['cuti'] = app("App\Http\Controllers\Kepegawaian\MasterCuti\ReadController")->getAll();
        return view('kepegawaian.master.cuti.index', $data);
    }
}

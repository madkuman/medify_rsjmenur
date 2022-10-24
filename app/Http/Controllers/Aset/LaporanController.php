<?php

namespace App\Http\Controllers\Aset;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //
    public function index()
    {
        $sidebar_active = 'laporan';
        return view('aset.laporan.index',compact('sidebar_active'));

    }
}

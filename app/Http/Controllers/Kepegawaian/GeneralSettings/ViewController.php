<?php

namespace App\Http\Controllers\Kepegawaian\GeneralSettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        $data['cuti_min_pengajuan_hari'] = config('app.kepegawaian_cuti_min_pengajuan_hari');
        $data['cuti_max_pengajuan_hari'] = config('app.kepegawaian_cuti_max_pengajuan_hari');
        return view('kepegawaian.master.general.index',$data);
    }
}

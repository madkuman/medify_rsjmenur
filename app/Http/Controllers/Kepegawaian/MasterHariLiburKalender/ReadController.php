<?php

namespace App\Http\Controllers\Kepegawaian\MasterHariLiburKalender;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterHariLiburKalender;

class ReadController extends Controller
{
    public function checkIsKerjaDate($carbon_date)
    {
        $hari = MasterHariLiburKalender::where('tanggal',$carbon_date->copy()->format('Y-m-d'))->first();

        /*
            return 1 jika masuk
            return 0 jika libur
        */

        if(empty($hari->id)) return 1;
        else return 0;
    }
}

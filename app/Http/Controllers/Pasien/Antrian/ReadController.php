<?php

namespace App\Http\Controllers\Pasien\Antrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\MesinAntrianPasien;

class ReadController extends Controller
{
    public function getSingle($mesin_antrian_id)
    {
        $mesin_antrian = MesinAntrianPasien::find($mesin_antrian_id);
        return $mesin_antrian;
    }
}

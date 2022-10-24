<?php

namespace App\Http\Controllers\Farmasi\WaktuEstimasiJenisResep;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\WaktuEstimasiJenisResep;

class ReadController extends Controller
{
    public function getAll()
    {
        return WaktuEstimasiJenisResep::all();
    }

    public function getWaktuRacikan()
    {
        return WaktuEstimasiJenisResep::where('id', 1)->first();
    }

    public function getWaktuNonRacikan()
    {
        return WaktuEstimasiJenisResep::where('id', 2)->first();
    }
}

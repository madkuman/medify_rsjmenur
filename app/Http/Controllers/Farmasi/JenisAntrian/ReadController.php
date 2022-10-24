<?php

namespace App\Http\Controllers\Farmasi\JenisAntrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\JenisAntrian;

class ReadController extends Controller
{
    public function getAll()
    {
        return JenisAntrian::all();
    }

    public function getByTipePerusahaan($tipe)
    {
        $jenis_antrian = JenisAntrian::where('perusahaan_tipe',$tipe)->whereNull('deleted_at')->first();
        return $jenis_antrian;
    }
}

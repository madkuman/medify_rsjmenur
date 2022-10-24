<?php

namespace App\Http\Controllers\Farmasi\WaktuEstimasiJenisResep;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\WaktuEstimasiJenisResep;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{
    public function edit($data)
    {
        $waktu_estimasi = WaktuEstimasiJenisResep::find($data->id);
        $waktu_estimasi->jenis_resep = $data->jenis_resep;
        $waktu_estimasi->waktu_estimasi = $data->waktu_estimasi;
        $waktu_estimasi->updated_by = Auth::user()->id;
        $waktu_estimasi->save();
    }
}

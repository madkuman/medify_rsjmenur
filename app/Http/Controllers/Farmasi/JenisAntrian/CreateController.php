<?php

namespace App\Http\Controllers\Farmasi\JenisAntrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\JenisAntrian;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function create($data)
    {
        $jenis_antrian = new JenisAntrian();
        $jenis_antrian->nama = $data->nama;
        $jenis_antrian->kode = $data->kode;
        $jenis_antrian->perusahaan_tipe = $data->perusahaan_tipe;
        $jenis_antrian->jenis_resep_antrian = $data->jenis_resep_antrian;
        $jenis_antrian->lokasi_departemen_id = $data->lokasi_departemen_id;
        $jenis_antrian->sound = $data->sound_path ?? null;
        $jenis_antrian->created_by = Auth::user()->id;
        $jenis_antrian->save();
    }
}

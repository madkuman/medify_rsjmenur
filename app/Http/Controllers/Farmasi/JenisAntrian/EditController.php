<?php

namespace App\Http\Controllers\Farmasi\JenisAntrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\JenisAntrian;

class EditController extends Controller
{
    public function edit($data)
    {
        $jenis_antrian = JenisAntrian::find($data->id);
        $jenis_antrian->nama = $data->nama;
        $jenis_antrian->kode = $data->kode;
        $jenis_antrian->perusahaan_tipe = $data->perusahaan_tipe;
        $jenis_antrian->jenis_resep_antrian = $data->jenis_resep_antrian;
        $jenis_antrian->lokasi_departemen_id = $data->lokasi_departemen_id;
        if(!empty($data->sound_path)){
            $jenis_antrian->sound = $data->sound_path;
        }
        $jenis_antrian->save();
    }
}

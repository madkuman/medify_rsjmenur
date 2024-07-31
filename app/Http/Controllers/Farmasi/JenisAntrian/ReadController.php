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

    public function getByFilter($tipe, $jenis_resep_antrian, $lokasi_departemen_id)
    {
        $jenis_antrian = JenisAntrian::with([])
            ->where(function ($query) use ($tipe) {
                $query->where('perusahaan_tipe',$tipe)
                    ->orWhere('perusahaan_tipe', "0");
            })
            ->where(function ($query) use ($jenis_resep_antrian) {
                $query->where('jenis_resep_antrian',$jenis_resep_antrian)
                    ->orWhere('jenis_resep_antrian', "0");
            })
            ->where(function ($query) use ($lokasi_departemen_id) {
                $query->where('lokasi_departemen_id',$lokasi_departemen_id)
                    ->orWhere('lokasi_departemen_id', "0");
            })
            ->get();
        $ordered_jenis_antrian = $jenis_antrian->sortByDesc(function ($item) {
            $score = 0;
            $score += $item->jenis_resep_antrian ? 100 : 0;
            $score += $item->lokasi_departemen_id ? 10 : 0;
            $score += $item->perusahaan_tipe ? 1 : 0;
            return $score;
        });
        return $ordered_jenis_antrian->first();
    }
}

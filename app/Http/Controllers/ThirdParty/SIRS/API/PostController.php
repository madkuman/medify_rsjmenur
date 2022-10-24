<?php

namespace App\Http\Controllers\ThirdParty\SIRS\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SIRS\LaporanCovid19;
use App\Models\SIRS\LogLaporanCovid19;

class PostController extends Controller
{
    public function createLaporanCovid($kasus, $response)
    {
        $sirs_laporan_id = $response['response']['data']['id'] ?? null;

        $laporan = new LaporanCovid19();
        $laporan->sirs_laporan_id = $sirs_laporan_id;
        $laporan->kasus_id = $kasus->id;
        $laporan->pasien_id = $kasus->pasien_id;
        $laporan->lokasi_id = $kasus->lokasi->lokasi_id ?? null;
        $laporan->created_by = auth()->user()->id;
        $laporan->save();
        return $laporan;
    }

    public function addLogLaporanCovid($tipe, $kasus_id, $laporan, $response)
    {
        $log = new LogLaporanCovid19();
        $log->tipe = $tipe;
        $log->kasus_id = $kasus_id;
        $log->laporan_covid_19_id = $laporan->id ?? null;
        $log->sirs_laporan_id = $laporan->sirs_laporan_id ?? null;
        $log->sirs_response = json_encode($response);
        $log->created_by = auth()->user()->id;
        $log->save();
    }
}

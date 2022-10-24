<?php

namespace App\Http\Controllers\Kasus\Psikologi\PemeriksaanPsikologisAnak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PemeriksaanPsikologisAnak;

class ReadController extends Controller
{
    public function getById($id)
    {
        $pemeriksaan_psikologis_anak = PemeriksaanPsikologisAnak::with(['creator'])->find($id);

        return $pemeriksaan_psikologis_anak;
    }

    public function getByKasusId($kasus_id)
    {
        $pemeriksaan_psikologis_anak = PemeriksaanPsikologisAnak::with(['creator'])->where('kasus_id',$kasus_id)->get();

        return $pemeriksaan_psikologis_anak;
    }
}

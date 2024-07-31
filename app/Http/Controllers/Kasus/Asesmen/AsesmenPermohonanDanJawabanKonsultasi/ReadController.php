<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi;

use DB;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use App\Http\Controllers\Controller;

class ReadController extends Controller
{
    public function getKasusSingle($nomor_kasus, $with = [])
    {
        $kasus = Kasus::with($with)->where('nomor_kasus', $nomor_kasus)->first();

        return $kasus;
    }

    public function getAlatBantu($kasus_id, $type = null)
    {
        $alat_bantu = AlatBantu::where('type', $type)->with(['creator'])->where('kasus_id', $kasus_id)->orderBy('id', 'desc')->get();

        return $alat_bantu;
    }

    public function getAlatBantuSingle($alat_bantu_id)
    {
        $alat_bantu = AlatBantu::find($alat_bantu_id);

        return $alat_bantu;
    }
}

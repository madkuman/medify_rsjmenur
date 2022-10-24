<?php

namespace App\Http\Controllers\Kasus\PotensiPurifikasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function cekPotensiRawatJalan(Request $request)
    {
        $result['fragmentasi'] = false;

        $fragmentasi = app(\App\Http\Controllers\RawatJalan\Transaksi\ReadController::class)->cekPotensiBPJSFragmentasi($request);
        if ($fragmentasi->isNotEmpty()) {
            $result['fragmentasi'] = true;
        }

        return $this->dynamicResponse($request, $result);
    }

    public function cekPotensiRawatInap(Request $request)
    {
        $result['readmisi'] = false;
        $result['beda_kelas'] = false;
        $result['lama_rawat_kurang'] = false;

        $kasus_id = $request->kasus_id ?? null;
        $pasien_id = $request->pasien_id ?? null;
        $kasus = app(\App\Http\Controllers\Kasus\Kasus\ReadController::class)->getById($kasus_id, ['pembayaran', 'diagnosisUtama', 'verifikasiKoderKasus']);

        // ? get kasus ranap seminggu terakhir dan bandingkan dx utama
        $request_kasus = new Request();
        $request_kasus->replace(['kasus' => $kasus, 'pasien_id' => $pasien_id]);
        $result['readmisi'] = app(\App\Http\Controllers\RawatInap\Transaksi\ReadController::class)->cekPotensiBPJSReadmisi($request_kasus);
        
        if (!empty($kasus)) {
            $result['beda_kelas'] = (($kasus->pembayaran->kelas_id ?? null) != $kasus->kelas_id);
            if (!empty($kasus->ranap_los) && $kasus->ranap_los < 3) {
                $result['lama_rawat_kurang'] = true;
            }
        }
        
        return $this->dynamicResponse($request, $result);
    }
}

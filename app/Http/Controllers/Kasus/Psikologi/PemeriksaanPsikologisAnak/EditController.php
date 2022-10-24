<?php

namespace App\Http\Controllers\Kasus\Psikologi\PemeriksaanPsikologisAnak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{
    public function edit($data, $kasus_id)
    {
        $pemeriksaan_psikologis_anak = app(\App\Http\Controllers\Kasus\Psikologi\PemeriksaanPsikologisAnak\ReadController::class)->getById($data->id);

        $pemeriksaan_psikologis_anak->kasus_id = $kasus_id;

        if(!empty($data->tanggal_pemeriksaan)){        
            $pemeriksaan_psikologis_anak->tanggal_pemeriksaan = Carbon::createFromFormat("d/m/Y", $data->tanggal_pemeriksaan)->toDateString();
        } else {
            $pemeriksaan_psikologis_anak->tanggal_pemeriksaan = null;
        }

        $pemeriksaan_psikologis_anak->tujuan_tes = $data->tujuan_tes;
        $pemeriksaan_psikologis_anak->kerja_sama = $data->kerja_sama;
        $pemeriksaan_psikologis_anak->tester_pasif_aktif = $data->tester_pasif_aktif;
        $pemeriksaan_psikologis_anak->tester_tegang_tenang = $data->tester_tegang_tenang;
        $pemeriksaan_psikologis_anak->tester_menjawab = $data->tester_menjawab;
        $pemeriksaan_psikologis_anak->sikap_keyakinan = $data->sikap_keyakinan;
        $pemeriksaan_psikologis_anak->sikap_penerimaan = $data->sikap_penerimaan;
        $pemeriksaan_psikologis_anak->kecepatan_kerja = $data->kecepatan_kerja;
        $pemeriksaan_psikologis_anak->kecekatan_kerja = $data->kecekatan_kerja;
        $pemeriksaan_psikologis_anak->pikiran_kerja = $data->pikiran_kerja;
        $pemeriksaan_psikologis_anak->kerapian_kerja = $data->kerapian_kerja;
        $pemeriksaan_psikologis_anak->perilaku = $data->perilaku;
        $pemeriksaan_psikologis_anak->pengetahuan_kegagalan = $data->pengetahuan_kegagalan;
        $pemeriksaan_psikologis_anak->usaha = $data->usaha;
        $pemeriksaan_psikologis_anak->kondisi_kegagalan = $data->kondisi_kegagalan;
        $pemeriksaan_psikologis_anak->ketenangan_bicara = $data->ketenangan_bicara;
        $pemeriksaan_psikologis_anak->reaksi_bicara = $data->reaksi_bicara;
        $pemeriksaan_psikologis_anak->kondisi_bicara = $data->kondisi_bicara;
        $pemeriksaan_psikologis_anak->kejelasan_jawaban = $data->kejelasan_jawaban;
        $pemeriksaan_psikologis_anak->kecakapan_bicara = $data->kecakapan_bicara;
        $pemeriksaan_psikologis_anak->kecepatan_reaksi = $data->kecepatan_reaksi;
        $pemeriksaan_psikologis_anak->reaksi_kehati_hatian = $data->reaksi_kehati_hatian;
        $pemeriksaan_psikologis_anak->reaksi_gerakan = $data->reaksi_gerakan;
        $pemeriksaan_psikologis_anak->keadaan_koordinasi_motorik = $data->keadaan_koordinasi_motorik;
        $pemeriksaan_psikologis_anak->kesimpulan = $data->kesimpulan;
        $pemeriksaan_psikologis_anak->saran = $data->saran;
        $pemeriksaan_psikologis_anak->catatan = $data->catatan;
        $pemeriksaan_psikologis_anak->kategori = $data->kategori;
        $pemeriksaan_psikologis_anak->kecerdasan_umum = $data->kecerdasan_umum;
        $pemeriksaan_psikologis_anak->pengamatan_ruang = $data->pengamatan_ruang;
        $pemeriksaan_psikologis_anak->kemampuan_analisa = $data->kemampuan_analisa;
        $pemeriksaan_psikologis_anak->kemampuan_berpikir_analogi = $data->kemampuan_berpikir_analogi;
        $pemeriksaan_psikologis_anak->emosi = $data->emosi;
        $pemeriksaan_psikologis_anak->kemampuan_sosial = $data->kemampuan_sosial;
        $pemeriksaan_psikologis_anak->kemampuan_adaptasi = $data->kemampuan_adaptasi;
        $pemeriksaan_psikologis_anak->motivasi_prestasi = $data->motivasi_prestasi;
        $pemeriksaan_psikologis_anak->updated_by = Auth::user()->id;
        $pemeriksaan_psikologis_anak->save();
        return $pemeriksaan_psikologis_anak;
    }
}

<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenPendidikanPasienDanKeluarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenPendidikanPasienDanKeluarga;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id)
    {
        $asesmen_pendidikan_pasien_dan_keluarga = new AsesmenPendidikanPasienDanKeluarga;

        $asesmen_pendidikan_pasien_dan_keluarga->agama_pasien = $req->agama_pasien;
        $asesmen_pendidikan_pasien_dan_keluarga->keyakinan_pasien_pantangan_pemeriksaan_hari_tertentu = $req->keyakinan_pasien_pantangan_pemeriksaan_hari_tertentu;
        $asesmen_pendidikan_pasien_dan_keluarga->keyakinan_pasien_pantangan_masuk_keluar_rs_hari_tertentu = $req->keyakinan_pasien_pantangan_masuk_keluar_rs_hari_tertentu;
        $asesmen_pendidikan_pasien_dan_keluarga->keyakinan_pasien_hanya_ingin_dilayani_sesama_jenis = $req->keyakinan_pasien_hanya_ingin_dilayani_sesama_jenis;
        $asesmen_pendidikan_pasien_dan_keluarga->keyakinan_pasien_pantangan_nomor_tertentu_yang_dihindari = $req->keyakinan_pasien_pantangan_nomor_tertentu_yang_dihindari;
        $asesmen_pendidikan_pasien_dan_keluarga->keyakinan_pasien_pantangan_nomor_tertentu_yang_dihindari = $req->keyakinan_pasien_pantangan_nomor_tertentu_yang_dihindari;
        $asesmen_pendidikan_pasien_dan_keluarga->keterangan_untuk_nilai_dan_keyakinan_pasien = $req->keterangan_untuk_nilai_dan_keyakinan_pasien;
        $asesmen_pendidikan_pasien_dan_keluarga->pendidikan_pasien_sd = $req->pendidikan_pasien_sd;
        $asesmen_pendidikan_pasien_dan_keluarga->pendidikan_pasien_smp = $req->pendidikan_pasien_smp;
        $asesmen_pendidikan_pasien_dan_keluarga->pendidikan_pasien_sma = $req->pendidikan_pasien_sma;
        $asesmen_pendidikan_pasien_dan_keluarga->pendidikan_pasien_perguruan_tinggi = $req->pendidikan_pasien_perguruan_tinggi;
        $asesmen_pendidikan_pasien_dan_keluarga->pendidikan_pasien_tidak_sekolah = $req->pendidikan_pasien_tidak_sekolah;
        $asesmen_pendidikan_pasien_dan_keluarga->pendidikan_pasien_lain_lain = $req->pendidikan_pasien_lain_lain;
        $asesmen_pendidikan_pasien_dan_keluarga->pendidikan_pasien_lain_lain = $req->pendidikan_pasien_lain_lain;
        $asesmen_pendidikan_pasien_dan_keluarga->bahasa_yang_digunakan_pasien_indonesia = $req->bahasa_yang_digunakan_pasien_indonesia;
        $asesmen_pendidikan_pasien_dan_keluarga->bahasa_yang_digunakan_pasien_isyarat = $req->bahasa_yang_digunakan_pasien_isyarat;
        $asesmen_pendidikan_pasien_dan_keluarga->bahasa_yang_digunakan_pasien_lain_lain = $req->bahasa_yang_digunakan_pasien_lain_lain;
        $asesmen_pendidikan_pasien_dan_keluarga->bahasa_yang_digunakan_pasien_lain_lain = $req->bahasa_yang_digunakan_pasien_lain_lain;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_pasien_tuli = $req->keterbatasan_pasien_tuli;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_pasien_bisu = $req->keterbatasan_pasien_bisu;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_pasien_kooperatif = $req->keterbatasan_pasien_kooperatif;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_pasien_perlu_kursi_roda = $req->keterbatasan_pasien_perlu_kursi_roda;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_pasien_hidup_dalam_pikirannya_sendiri = $req->keterbatasan_pasien_hidup_dalam_pikirannya_sendiri;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_pasien_tidak_ada_keterbatasan_fisik = $req->keterbatasan_pasien_tidak_ada_keterbatasan_fisik;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_pasien_tampak_mutualisme_atau_negativistic = $req->keterbatasan_pasien_tampak_mutualisme_atau_negativistic;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_pasien_mampu_berdiskusi = $req->keterbatasan_pasien_mampu_berdiskusi;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_pasien_mampu_berdiskusi = $req->keterbatasan_pasien_mampu_berdiskusi;
        $asesmen_pendidikan_pasien_dan_keluarga->emosi_motivasi_pasien_tenang = $req->emosi_motivasi_pasien_tenang;
        $asesmen_pendidikan_pasien_dan_keluarga->emosi_motivasi_pasien_labil = $req->emosi_motivasi_pasien_labil;
        $asesmen_pendidikan_pasien_dan_keluarga->emosi_motivasi_pasien_tampak_acuh = $req->emosi_motivasi_pasien_tampak_acuh;
        $asesmen_pendidikan_pasien_dan_keluarga->emosi_motivasi_pasien_belum_mampu_diajak_komunikasi = $req->emosi_motivasi_pasien_belum_mampu_diajak_komunikasi;
        $asesmen_pendidikan_pasien_dan_keluarga->emosi_motivasi_pasien_tampak_agresif = $req->emosi_motivasi_pasien_tampak_agresif;
        $asesmen_pendidikan_pasien_dan_keluarga->emosi_motivasi_pasien_mampu_komunikasi = $req->emosi_motivasi_pasien_mampu_komunikasi;
        $asesmen_pendidikan_pasien_dan_keluarga->emosi_motivasi_pasien_mampu_komunikasi = $req->emosi_motivasi_pasien_mampu_komunikasi;
        $asesmen_pendidikan_pasien_dan_keluarga->kesediaan_pasien_bersedia_diberi_informasi = $req->kesediaan_pasien_bersedia_diberi_informasi;
        $asesmen_pendidikan_pasien_dan_keluarga->kesediaan_pasien_mampu_menerima_informasi = $req->kesediaan_pasien_mampu_menerima_informasi;
        $asesmen_pendidikan_pasien_dan_keluarga->kesediaan_pasien_belum_mampu_menerima_informasi = $req->kesediaan_pasien_belum_mampu_menerima_informasi;
        $asesmen_pendidikan_pasien_dan_keluarga->kesediaan_pasien_tidak_bersedia_diberi_informasi = $req->kesediaan_pasien_tidak_bersedia_diberi_informasi;
        $asesmen_pendidikan_pasien_dan_keluarga->kesediaan_pasien_tidak_bersedia_diberi_informasi = $req->kesediaan_pasien_tidak_bersedia_diberi_informasi;
        $asesmen_pendidikan_pasien_dan_keluarga->hubungan_dengan_pasien = $req->hubungan_dengan_pasien;
        $asesmen_pendidikan_pasien_dan_keluarga->keyakinan_keluarga_pantangan_pemeriksaan_hari_tertentu = $req->keyakinan_keluarga_pantangan_pemeriksaan_hari_tertentu;
        $asesmen_pendidikan_pasien_dan_keluarga->keyakinan_keluarga_pantangan_masuk_keluar_rs_hari_tertentu = $req->keyakinan_keluarga_pantangan_masuk_keluar_rs_hari_tertentu;
        $asesmen_pendidikan_pasien_dan_keluarga->keyakinan_keluarga_hanya_ingin_dilayani_sesama_jenis = $req->keyakinan_keluarga_hanya_ingin_dilayani_sesama_jenis;
        $asesmen_pendidikan_pasien_dan_keluarga->keyakinan_keluarga_pantangan_nomor_tertentu_yang_dihindari = $req->keyakinan_keluarga_pantangan_nomor_tertentu_yang_dihindari;
        $asesmen_pendidikan_pasien_dan_keluarga->keyakinan_keluarga_pantangan_nomor_tertentu_yang_dihindari = $req->keyakinan_keluarga_pantangan_nomor_tertentu_yang_dihindari;
        $asesmen_pendidikan_pasien_dan_keluarga->keterangan_untuk_nilai_dan_keyakinan_keluarga = $req->keterangan_untuk_nilai_dan_keyakinan_keluarga;
        $asesmen_pendidikan_pasien_dan_keluarga->pendidikan_keluarga_sd = $req->pendidikan_keluarga_sd;
        $asesmen_pendidikan_pasien_dan_keluarga->pendidikan_keluarga_smp = $req->pendidikan_keluarga_smp;
        $asesmen_pendidikan_pasien_dan_keluarga->pendidikan_keluarga_sma = $req->pendidikan_keluarga_sma;
        $asesmen_pendidikan_pasien_dan_keluarga->pendidikan_keluarga_perguruan_tinggi = $req->pendidikan_keluarga_perguruan_tinggi;
        $asesmen_pendidikan_pasien_dan_keluarga->pendidikan_keluarga_tidak_sekolah = $req->pendidikan_keluarga_tidak_sekolah;
        $asesmen_pendidikan_pasien_dan_keluarga->pendidikan_keluarga_lain_lain = $req->pendidikan_keluarga_lain_lain;
        $asesmen_pendidikan_pasien_dan_keluarga->pendidikan_keluarga_lain_lain = $req->pendidikan_keluarga_lain_lain;
        $asesmen_pendidikan_pasien_dan_keluarga->bahasa_keluarga_indonesia = $req->bahasa_keluarga_indonesia;
        $asesmen_pendidikan_pasien_dan_keluarga->bahasa_keluarga_isyarat = $req->bahasa_keluarga_isyarat;
        $asesmen_pendidikan_pasien_dan_keluarga->bahasa_keluarga_lain_lain = $req->bahasa_keluarga_lain_lain;
        $asesmen_pendidikan_pasien_dan_keluarga->bahasa_keluarga_lain_lain = $req->bahasa_keluarga_lain_lain;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_keluarga_tuli = $req->keterbatasan_keluarga_tuli;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_keluarga_bisu = $req->keterbatasan_keluarga_bisu;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_keluarga_kooperatif = $req->keterbatasan_keluarga_kooperatif;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_keluarga_perlu_kursi_roda = $req->keterbatasan_keluarga_perlu_kursi_roda;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_keluarga_tidak_ada_keterbatasan_fisik = $req->keterbatasan_keluarga_tidak_ada_keterbatasan_fisik;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_keluarga_mampu_berdiskusi = $req->keterbatasan_keluarga_mampu_berdiskusi;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_keluarga_lain_lain = $req->keterbatasan_keluarga_lain_lain;
        $asesmen_pendidikan_pasien_dan_keluarga->keterbatasan_keluarga_lain_lain = $req->keterbatasan_keluarga_lain_lain;
        $asesmen_pendidikan_pasien_dan_keluarga->emosi_motivasi_keluarga_tenang = $req->emosi_motivasi_keluarga_tenang;
        $asesmen_pendidikan_pasien_dan_keluarga->emosi_motivasi_keluarga_labil = $req->emosi_motivasi_keluarga_labil;
        $asesmen_pendidikan_pasien_dan_keluarga->emosi_motivasi_keluarga_tampak_acuh = $req->emosi_motivasi_keluarga_tampak_acuh;
        $asesmen_pendidikan_pasien_dan_keluarga->emosi_motivasi_keluarga_belum_mampu_diajak_komunikasi = $req->emosi_motivasi_keluarga_belum_mampu_diajak_komunikasi;
        $asesmen_pendidikan_pasien_dan_keluarga->emosi_motivasi_keluarga_mampu_komunikasi = $req->emosi_motivasi_keluarga_mampu_komunikasi;
        $asesmen_pendidikan_pasien_dan_keluarga->emosi_motivasi_keluarga_mampu_komunikasi = $req->emosi_motivasi_keluarga_mampu_komunikasi;
        $asesmen_pendidikan_pasien_dan_keluarga->kesediaan_keluarga_bersedia_diberi_informasi = $req->kesediaan_keluarga_bersedia_diberi_informasi;
        $asesmen_pendidikan_pasien_dan_keluarga->kesediaan_keluarga_mampu_menerima_informasi = $req->kesediaan_keluarga_mampu_menerima_informasi;
        $asesmen_pendidikan_pasien_dan_keluarga->kesediaan_keluarga_tidak_bersedia_diberi_informasi = $req->kesediaan_keluarga_tidak_bersedia_diberi_informasi;
        $asesmen_pendidikan_pasien_dan_keluarga->kesediaan_keluarga_tidak_bersedia_diberi_informasi = $req->kesediaan_keluarga_tidak_bersedia_diberi_informasi;
        $asesmen_pendidikan_pasien_dan_keluarga->edukasi_pasien_penyakit_yang_diderita = $req->edukasi_pasien_penyakit_yang_diderita;
        $asesmen_pendidikan_pasien_dan_keluarga->edukasi_pasien_teknik_rehabilitasi_terapi_kerja_latihan_asertif = $req->edukasi_pasien_teknik_rehabilitasi_terapi_kerja_latihan_asertif;
        $asesmen_pendidikan_pasien_dan_keluarga->edukasi_pasien_tindakan_keperawatan_fiksasi_tak_dll = $req->edukasi_pasien_tindakan_keperawatan_fiksasi_tak_dll;
        $asesmen_pendidikan_pasien_dan_keluarga->edukasi_pasien_tindakan_medis_ect_konvensional_dll = $req->edukasi_pasien_tindakan_medis_ect_konvensional_dll;
        $asesmen_pendidikan_pasien_dan_keluarga->edukasi_pasien_pemeriksaan_penunjang_lab_rontgen_dll = $req->edukasi_pasien_pemeriksaan_penunjang_lab_rontgen_dll;
        $asesmen_pendidikan_pasien_dan_keluarga->edukasi_pasien_pemeriksaan_penunjang_lab_rontgen_dll = $req->edukasi_pasien_pemeriksaan_penunjang_lab_rontgen_dll;
        $asesmen_pendidikan_pasien_dan_keluarga->masalah_keperawatan = $req->masalah_keperawatan;
        if (!empty($req->rencana_edukasi_pasien_tanggal)) {
            $asesmen_pendidikan_pasien_dan_keluarga->rencana_edukasi_pasien_tanggal = Carbon::createFromFormat("d/m/Y", $req->rencana_edukasi_pasien_tanggal);
        } else {
            $asesmen_pendidikan_pasien_dan_keluarga->rencana_edukasi_pasien_tanggal = null;
        }
        $asesmen_pendidikan_pasien_dan_keluarga->kebutuhan_edukasi_keluarga_obat_yang_dikonsumsi = $req->kebutuhan_edukasi_keluarga_obat_yang_dikonsumsi;
        $asesmen_pendidikan_pasien_dan_keluarga->kebutuhan_edukasi_keluarga_managemen_nyeri = $req->kebutuhan_edukasi_keluarga_managemen_nyeri;
        $asesmen_pendidikan_pasien_dan_keluarga->kebutuhan_edukasi_keluarga_diet_dan_nutrisi = $req->kebutuhan_edukasi_keluarga_diet_dan_nutrisi;
        $asesmen_pendidikan_pasien_dan_keluarga->kebutuhan_edukasi_keluarga_cuci_tangan = $req->kebutuhan_edukasi_keluarga_cuci_tangan;
        $asesmen_pendidikan_pasien_dan_keluarga->kebutuhan_edukasi_keluarga_inform_consent = $req->kebutuhan_edukasi_keluarga_inform_consent;
        $asesmen_pendidikan_pasien_dan_keluarga->kebutuhan_edukasi_keluarga_general_consent = $req->kebutuhan_edukasi_keluarga_general_consent;
        $asesmen_pendidikan_pasien_dan_keluarga->kebutuhan_edukasi_keluarga_general_consent = $req->kebutuhan_edukasi_keluarga_general_consent;
        if (!empty($req->rencana_edukasi_keluarga_tanggal)) {
            $asesmen_pendidikan_pasien_dan_keluarga->rencana_edukasi_keluarga_tanggal = Carbon::createFromFormat("d/m/Y", $req->rencana_edukasi_keluarga_tanggal);
        } else {
            $asesmen_pendidikan_pasien_dan_keluarga->rencana_edukasi_keluarga_tanggal = null;
        }
        $asesmen_pendidikan_pasien_dan_keluarga->agama_keluarga_pasien = $req->agama_keluarga_pasien;


        $hambatan = '';
        for ($i = 0; $i < count($req->hambatan); $i++) {
            $temp = explode(',', $req->hambatan[$i]);
            foreach ($temp as $item) {
                $hambatan .= $item;
                $hambatan .= ', ';
            };
        };
        $penerjemah = '';
        $i = 0;
        $temp = explode(',', $req->penerjemah[0]);
        foreach ($temp as $item) {
            $penerjemah .= $item;
            $i++;
            $penerjemah .= ', ';
        };
        $pembelajaran = '';
        for ($i = 0; $i < count($req->pembelajaran); $i++) {
            $temp = explode(',', $req->pembelajaran[$i]);
            foreach ($temp as $item) {
                $pembelajaran .= $item;
                $pembelajaran .= ', ';
            };
            $asesmen_pendidikan_pasien_dan_keluarga->pembelajaran = $pembelajaran;
        };
        $asesmen_pendidikan_pasien_dan_keluarga->hambatan = $hambatan;
        $asesmen_pendidikan_pasien_dan_keluarga->penerjemah = $penerjemah;
        $asesmen_pendidikan_pasien_dan_keluarga->created_by = Auth::user()->id;
        $asesmen_pendidikan_pasien_dan_keluarga->kasus_id = $kasus_id;
        $asesmen_pendidikan_pasien_dan_keluarga->save();
    }
}

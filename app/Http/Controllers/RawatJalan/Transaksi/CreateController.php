<?php

namespace App\Http\Controllers\RawatJalan\Transaksi;

use App\Models\RawatJalan\Poliklinik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Transaksi;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\BPJSSEP;
use App\Models\RawatJalan\AntrianCall;
use App\Models\RawatJalan\AntrianLevel;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class CreateController extends Controller
{
    protected static $status_menunggu = [0, 3];
    public function create($data_request)
    {
        $data = (object) $data_request;
        $pasien = Pasien::find($data->pasien_id);
        $konfirmasi_at = Carbon::now();
        $konfirmasi_by = Auth::user()->id ?? null;
        $is_create_antrian = true;

        $data = app('App\Http\Controllers\RawatJalan\DokterJadwal\ReadController')->getForTransaksi($data);

        $transaksi = new Transaksi;
        if (!empty($data->mesin_antrian_id)) {
            $mesin_antrian_data = app('App\Http\Controllers\Pasien\Antrian\ReadController')->getSingle($data->mesin_antrian_id);
            if (!empty($mesin_antrian_data->transaksi_rawat_jalan)) {
                $transaksi = $mesin_antrian_data->transaksi_rawat_jalan;
            }
        }

        if (empty($transaksi->nomor_antrian)) {
            $data = $this->getDataAntrian($data, $pasien);
            $poliklinik = Poliklinik::find($data->poli_id);
            if (!empty($data->durasi) && $data->durasi > 0) {
                $estimasi_per_px = ceil($data->durasi / 60);
            } else if ($poliklinik != null && $poliklinik->interval_antrian != null) {
                $estimasi_per_px = $poliklinik->interval_antrian;
            } else {
                $estimasi_per_px = 3; //default
            }
            $waktu_estimasi = $this->getEstimasiWaktuPemeriksaan($data->poli_id, $data, $estimasi_per_px);
        } else {
            $data->no_antrian = $transaksi->nomor_antrian;
            $waktu_estimasi = $transaksi->ordered_at;
            $is_create_antrian = false;
        }
        //dd($transaksi);
        $transaksi->poliklinik_id = $data->poli_id;
        $transaksi->pasien_id = $data->pasien_id;
        $transaksi->nomor_antrian = $data->no_antrian;
        $transaksi->kelas_id = $data->kelas_id;
        $transaksi->waktu_estimasi = $waktu_estimasi;
        $transaksi->ordered_at = $waktu_estimasi;

        if (!empty($data->kasus_id)) {
            $transaksi->kasus_id = $data->kasus_id;
            $kasus = Kasus::find($data->kasus_id);
        }
        if (!empty($data->rujuk_id)) {
            $transaksi->permintaan_rujuk_id = $data->rujuk_id;
        }
        $transaksi->nomor_sep = $data->nomor_sep;
        $transaksi->asal_rujukan = $data->asal_rujukan;
        $transaksi->created_by = Auth::user()->id;
        $transaksi->pasien_pembayaran_id = $data->bayar_id;
        $transaksi->waktu_masuk = Carbon::now();

        $transaksi->usia_masuk = $pasien->getAgeDayAttribute(Carbon::today()->toDateString());
        $transaksi->dokter_id = $data->dokter_id;
        $transaksi->dokter_jadwal_id = $data->dokter_jadwal->id;
        // Jika pendaftaran dari medify online maka verifikasi = 0 dan sebaliknya
        $transaksi->status = $data->is_online == 1 ? 3 : 0;
        if ($data->is_online == 1 || !empty($data->mesin_antrian_id)) {
            $transaksi->status = 3;
        }
        if (!empty($data->mesin_antrian_id)) {
            $transaksi->is_mesin_antrian = 1;
            $transaksi->save();

            if (!empty($data->mesin_antrian_konfirmasi)) {
                $transaksi->status = 0;
                $pasien_mesin_update['konfirmasi_by'] = Auth::user()->id;
            } else {
                $konfirmasi_at = null;
                $konfirmasi_by = null;
            }
            $pasien_mesin_update['poliklinik_id'] = $data->poli_id;
            $pasien_mesin_update['dokter_id'] = $data->dokter_id ?? null;
            $pasien_mesin_update['id_jadwal'] = $data->dokter_jadwal->id ?? null;
            $pasien_mesin_update['transaksi_rawat_jalan_id'] = $transaksi->id;
            $pasien_mesin_edit = app('App\Http\Controllers\Pasien\Antrian\CreateController')->edit($data->mesin_antrian_id, $pasien_mesin_update);
        }
        $transaksi->is_online = $data->is_online;

        $transaksi->konfirmasi_at = $konfirmasi_at;
        $transaksi->konfirmasi_by = $konfirmasi_by;

        $transaksi->is_video = $data->is_video;
        if ($data->is_video == 1) {
            $transaksi->status = 0;
        }
        $transaksi->save();

        if ($data->is_video) {
            $video = app('App\Http\Controllers\RawatJalan\Video\CreateController')->createVideoWithoutSession($transaksi->id, $data->durasi);
        }

        if (isset($data->sep))
            $this->insertSEP($kasus, $data->nomor_sep, $data->sep->no_bpjs, 0, $data->sep);

        //untuk create antrian
        if ($is_create_antrian) {
            $antrian_data['is_bpjs'] = $data->is_bpjs;
            $antrian_data['level'] = $data->antrian_level->id;
            $antrian = app('App\Http\Controllers\RawatJalan\AntrianCall\CreateController')->create($antrian_data, $transaksi);
        }
        return $transaksi;
    }

    public function insertSEP($kasus, $nomor_sep, $no_bpjs, $total_plafon = 0, $bpjs_sep = null)
    {
        $sep = BPJSSEP::where('no_sep', $nomor_sep)->first();
        $sep = new BPJSSEP;
        if (!isset($sep)) {

            $sep->save();
        }
        // $sep->kasus_id = $kasus->id;
        if (isset($kasus)) {
            $kasus->bpjs()->attach($sep->id);
            $kasus->sep_id = $sep->id;
            $kasus->save();
        }

        $sep->no_sep = $nomor_sep;
        $sep->no_bpjs = $no_bpjs;
        $sep->total_plafon = $total_plafon;

        if (isset($bpjs_sep)) {
            $bpjs_sep = (object) $bpjs_sep;
            $sep->jenis_pelayanan = $bpjs_sep->jenis_pelayanan;
            $sep->kelas_rawat = $bpjs_sep->kelas_rawat;
            $sep->pasien_id = $bpjs_sep->pasien_id;
            $sep->asal_rujukan = $bpjs_sep->asal_rujukan;
            $sep->tgl_rujukan = $bpjs_sep->tgl_rujukan;
            $sep->no_rujukan =  $bpjs_sep->no_rujukan;
            $sep->ppk_rujukan = $bpjs_sep->ppk_rujukan;
            $sep->catatan = $bpjs_sep->catatan;
            $sep->poli_tujuan = $bpjs_sep->poli_tujuan;
            $sep->poli_eksekutif = $bpjs_sep->poli_eksekutif;
            $sep->cob = $bpjs_sep->cob;
            $sep->katarak = $bpjs_sep->katarak;
            $sep->jaminan_lakalantas = $bpjs_sep->jaminan_lakalantas;
            $sep->penjamin_laka = $bpjs_sep->penjamin_laka;
            $sep->tgl_kejadian = $bpjs_sep->tgl_kejadian;
            $sep->keterangan_penjamin = $bpjs_sep->keterangan_penjamin;
            $sep->suplesi = $bpjs_sep->suplesi;
            $sep->no_suplesi = $bpjs_sep->no_suplesi;
            $sep->prov_laka = $bpjs_sep->prov_laka;
            $sep->kab_laka = $bpjs_sep->kab_laka;
            $sep->kc_laka = $bpjs_sep->kc_laka;
            $sep->skdp = $bpjs_sep->skdp;
            $sep->dpjp = $bpjs_sep->dpjp;
            $sep->no_telp = $bpjs_sep->no_telp;
            $sep->tgl_pulang = null;
        }
        $sep->save();

        return $sep;
    }

    public function getDataAntrian($data)
    {

        if (empty($data->antrian_kelas)) {
            $level = AntrianLevel::where('level', 2)->first(); //default umum
        } else {
            $level = AntrianLevel::find($data->antrian_kelas);
        }

        $date_check = Carbon::today();
        if (!is_null($data->tanggal_pemesanan)) {
            $date_check = Carbon::parse($data->tanggal_pemesanan);
        }

        $date_order = $date_check->copy()->toDateString();
        $dokter_id = $data->dokter_id ?? null;
        $get_antrian = Transaksi::with('antrian:id,transaksi_id,antrian_level_id')
            ->select(DB::raw('count(transaksi.id) as total'))
            ->whereHas('antrian', function ($q) use ($level) {
                $q->where('antrian_level_id', $level->id);
            })
            ->where('poliklinik_id', $data->poli_id)
            ->whereDate('ordered_at', $date_order);

        if (config('medify.rawatjalan.nomor_antrian.per_dokter', 0)) {
            $get_antrian = $get_antrian->where('dokter_id', $dokter_id);
        }
        $get_antrian = $get_antrian->first();

        $total_antrian = $get_antrian->total ?? 0;

        $dokter = app('App\Http\Controllers\RawatJalan\Dokter\ReadController')->getId($data->dokter_id)->kode_dokter;

        $new_number = $total_antrian + 1;
        $new_number = str_pad($new_number, 3, "0", STR_PAD_LEFT);

        $kode_dokter = $dokter ? $dokter . '-' : '';

        $data->antrian_level = $level;
        $data->no_antrian = $kode_dokter . $level->kode . $new_number;

        return $data;
    }

    public function getEstimasiWaktuPemeriksaan($poli_id, $data = null, $estimasi_per_px = 3)
    {
        if (config('medify.rawatjalan.nomor_antrian.per_dokter', 0) && empty($data->dokter_id)) {
            $dokter_jadwal = json_decode(app('App\Http\Controllers\RawatJalan\DokterJadwal\ReadController')->getDokterTodayByPoli($poli_id));
            $data->dokter_id = $dokter_jadwal[0]->id ?? null;
        }

        $dokter_jadwal = $data->dokter_jadwal;
        $dokter_jam_buka = $dokter_jadwal->jam_buka ?? null;
        $dokter_jam_buka_exp = explode(':', $dokter_jam_buka);
        $dokter_jam_buka_hour = !empty($dokter_jam_buka_exp[0]) ? (int) $dokter_jam_buka_exp[0] : 8;

        $antrian_level = $data->antrian_level;

        $today = Carbon::today();
        if (empty($data->tanggal_pemesanan)) {
            $tanggal = $today->copy();
        } else {
            $tanggal = Carbon::parse($data->tanggal_pemesanan);
        }

        $start = $tanggal->copy()->startOfDay();
        $end = $tanggal->copy()->endOfDay();
        $layanan_open = $tanggal->copy()->addHours($dokter_jam_buka_hour);

        $transaksi = Transaksi::with('antrian')
            ->whereHas('antrian', function ($q) use ($antrian_level) {
                $q->whereIn('antrian_level_id', $antrian_level);
            })
            ->where('poliklinik_id', $poli_id);

        if (config('medify.rawatjalan.nomor_antrian.per_dokter', 0)) {
            $transaksi = $transaksi->where('dokter_id', $data->dokter_id);
            if (!empty($dokter_jadwal)) {
                $transaksi = $transaksi->where('dokter_jadwal_id', $dokter_jadwal->id);
            }
        }

        $transaksi = $transaksi->whereBetween('ordered_at', [$start, $end]);
        $latest_transaksi = (clone $transaksi)->latest()->first();
        if (!empty($latest_transaksi)) {
            if (!empty($latest_transaksi->ordered_at)) {
                $estimasi = Carbon::parse($latest_transaksi->ordered_at)->addMinutes($estimasi_per_px);
            } else {
                $estimasi = $layanan_open->copy()->addMinutes($estimasi_per_px);
            }
        } else {
            $estimasi = $layanan_open;
        }

        if ($estimasi <= Carbon::now()) {
            $estimasi = Carbon::now()->copy()->addMinutes($estimasi_per_px);
        }

        return $estimasi;
    }
}

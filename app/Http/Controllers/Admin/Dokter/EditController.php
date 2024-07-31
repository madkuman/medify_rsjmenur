<?php

namespace App\Http\Controllers\Admin\Dokter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Dokter;
use App\Models\RawatJalan\DokterJadwal;
use App\Models\RawatJalan\Poliklinik;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{
    public function importHfis()
    {
        $auth_id = auth()->id();
        $error_metadata = (object) ['code' => 500, 'message' => 'Invalid Json'];
        $message = [];

        $list_poliklinik_bpjs = Poliklinik::with('ruangan')->whereNotNull('bpjs_id')->get()->keyBy('bpjs_id');
        $list_dokter = Dokter::with('jadwal')->whereNotNull('bpjs_kode_dpjp')->get()->keyBy('bpjs_kode_dpjp');

        $date_period = CarbonPeriod::between(now()->format('Y-m-d'), now()->addDays(6)->format('Y-m-d'));
        $list_jadwal = [];
        foreach ($date_period as $date) {
            foreach ($list_poliklinik_bpjs as $kode_poli => $poliklinik_item) {
                $referensi = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\JadwalDokter\ReadController::class)->getReferensiJadwalDokter($kode_poli, $date->format('Y-m-d'));
                $referensi = json_decode($referensi);

                $referensi_metadata = $referensi->metadata ?? $referensi->metaData ?? $error_metadata;
                if(isset($referensi_metadata->Code)) {
                    $referensi_metadata->code = $referensi_metadata->Code;
                }
                if ($referensi_metadata->code == 200) {
                    $list_jadwal = array_merge($list_jadwal, $referensi->response);
                } else if ($referensi_metadata->code == 201) {
                    if ($referensi_metadata->message == 'No Content') {
                        $message[] = "request : ".$date->format('Y-m-d')." ".$kode_poli." : No Content";
                    } else {
                        $message[] = "request : ".$date->format('Y-m-d')." ".$kode_poli." : Error";
                    }
                } else {
                    return $referensi_metadata->message;
                } 
            }
        }

        $list_jadwal = collect($list_jadwal);
        #remove hari libur nasional
        $list_jadwal = $list_jadwal->where('hari', '!=', 8);

        foreach ($list_jadwal->groupBy('kodedokter') as $kode_dokter => $list_jadwal_item) {
            if (!isset($list_dokter[$kode_dokter])) {
                $message[] = "sistem :  Dokter Kode ".$kode_dokter." : Belum terdaftar disistem";
                continue;
            } 

            $dokter = $list_dokter[$kode_dokter];

            $list_jadwal_saved = [];
            foreach ($list_jadwal_item->sortBy('hari') as $item) {
                if (!isset($list_poliklinik_bpjs[$item->kodepoli])) {
                    $message[] = "sistem :  Kode Poli ".$item->kodepoli." : Belum terdaftar disistem";
                    continue; #poliklinik tidak ditemukan
                }

                $ex_jadwal = explode('-', $item->jadwal);
                $jam_buka = $ex_jadwal[0];
                $jam_tutup = $ex_jadwal[1];
                $poliklinik = $list_poliklinik_bpjs[$item->kodepoli];

                $ruangan = $poliklinik->ruangan->where('dokter_id', $dokter->id)->first();
                if ($ruangan == null) {
                    $ruangan = $poliklinik->ruangan->where('dokter_id', 0)->first();
                }
                if ($ruangan == null) {
                    $message[] = "sistem :  Poli ".$poliklinik->name." : Belum memiliki ruangan yang sesuai dengan dokter ".$dokter->name;
                    continue;
                }

                $dokter_jadwal = $dokter->jadwal
                    ->where('poliklinik_id', $poliklinik->id)
                    ->where('ruangan_id', $ruangan->id)
                    ->where('hari', $item->hari)
                    ->where('jam_buka', $jam_buka)
                    ->where('jam_tutup', $jam_tutup)
                    ->first();
                if ($dokter_jadwal == null) {
                    $dokter_jadwal = new DokterJadwal;
                }
                $dokter_jadwal->dokter_id = $dokter->id;
                $dokter_jadwal->poliklinik_id = $poliklinik->id;
                $dokter_jadwal->ruangan_id = $ruangan->id;
                $dokter_jadwal->hari_order = $item->hari;
                $dokter_jadwal->hari = ucfirst(strtolower($item->namahari));
                $dokter_jadwal->jam_buka = $jam_buka;
                $dokter_jadwal->jam_tutup = $jam_tutup;
                $dokter_jadwal->nama_poli = $poliklinik->name;
                $dokter_jadwal->nama_dokter = $dokter->name;
                $dokter_jadwal->created_by = $auth_id;
                $dokter_jadwal->save();

                $list_jadwal_saved[] = $dokter_jadwal->id;
            }

            #delete all other jadwal for this dokter
            DokterJadwal::where('dokter_id', $dokter->id)->whereNotIn('id', $list_jadwal_saved)->delete();
        }
        return $message;
    }
}

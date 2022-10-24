<?php

namespace App\Http\Controllers\RawatJalan\DokterJadwal;

use App\Models\RawatJalan\Ruangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\RawatJalan\DokterJadwal;
use App\Models\RawatJalan\DokterJadwalTemp;
use App\Models\RawatJalan\Dokter;
use App\User;

class ReadController extends Controller
{
    public function getDokterToday()
    {
        $hari = Carbon::today()->dayOfWeek;
        $userId = DokterJadwal::where('hari_order', $hari)->pluck('user_id');
        return json_encode(Dokter::whereIn('id', $userId)->get());
    }


    public function getDokterTodayByPoli($poli_id)
    {
       //cek jadwal temp today
    	$hari = Carbon::today()->dayOfWeek;
    	$date = Carbon::today()->toDateString();
        $jadwal_temp = DokterJadwalTemp::where('poliklinik_id', $poli_id)->where('berlaku', $date)->pluck('dokter_id')->toArray();
        if (count($jadwal_temp) > 0) {
            $ruangan_temp = DokterJadwalTemp::where('poliklinik_id', $poli_id)->where('berlaku', $date)->pluck('ruangan_id')->toArray();
            $dokterId = DokterJadwal::where('hari_order', $hari)->where('poliklinik_id', $poli_id)->whereNotIn('ruangan_id', $ruangan_temp)->pluck('dokter_id')->toArray();
        } else {
            $dokterId = DokterJadwal::where('hari_order', $hari)->where('poliklinik_id', $poli_id)->pluck('dokter_id')->toArray();
        }
        $dokter_ids = array_merge($jadwal_temp, $dokterId);
        $dokter = Dokter::withCount('jobs_today')->whereIn('id', $dokter_ids)->orderBy('jobs_today_count')->get();
    	return json_encode($dokter);
    }


    public function getDokterBPJSTodayByPoli($kode_poli)
    {
        $hari = Carbon::today()->dayOfWeek;
        $userId = DokterJadwal::where('hari_order', $hari)->whereHas('poli', function($q) use($kode_poli){
            $q->where('bpjs_id', $kode_poli);
        })->pluck('dokter_id');
        $dokter = json_encode(Dokter::whereIn('id', $userId)->whereNotNull('bpjs_kode_dpjp')->get());
        if($dokter == "[]")
            return $this->getDokterBPJS();
        else
            return $dokter;
    }

    public function getDokterBPJS()
    {
        $user = Dokter::whereNotNull('bpjs_kode_dpjp')->get();
        return json_encode($user);
    }

    public function getDokterBPJSRaw()
    {
        $user = Dokter::whereNotNull('bpjs_kode_dpjp')->get();
        return $user;
    }

    

    public function getDokterJadwal(Request $request)
    {
        $dokter_id = $request->dokter_id;
        $dokter = DokterJadwal::where('dokter_id', $dokter_id)->with('poli')->get();
        return json_encode($dokter);
    }

    public function getForTransaksi($data)
    {
        $tanggal_pemesanan = $data->tanggal_pemesanan ?? Carbon::now();
        $jadwal_id = $data->dokter_jadwal_id ?? null;
        $poli_id = $data->poli_id;
        $dokter_id = $data->dokter_id ?? null;

        $tanggal = \Carbon\Carbon::parse($tanggal_pemesanan);
        $date_day = $tanggal->copy()->dayOfWeek;
        if (empty($jadwal_id)) {
            $jadwal = DokterJadwal::where('poliklinik_id', $poli_id)
                    ->where('hari_order', $date_day)
                    ->where('dokter_id', $dokter_id)
                    ->latest()->first();
        } else {
            $jadwal = DokterJadwal::find($jadwal_id);
        }
        $data->dokter_jadwal = $jadwal;
        return $data;
    }

    public function getByTanggalJam($dokter_id, $jam_buka, $jam_tutup, $tanggal_pemesanan)
    {
        
        $tanggal = \Carbon\Carbon::parse($tanggal_pemesanan);
        $date_day = $tanggal->copy()->dayOfWeek;
        return DokterJadwal::where(function($query) use ($jam_buka, $jam_tutup){
                            $query->whereBetween('jam_buka', [$jam_buka, $jam_tutup])
                            ->orWhereBetween('jam_tutup', [$jam_buka, $jam_tutup]);
                        })
                        ->where(function ($q) use ($date_day) {
                            $q->where('hari_order', $date_day);
                        })
                        ->where('dokter_id', $dokter_id)
                        ->latest()->first();
    }

    public function getDokterRuangan($poli_id, $dokter_id = 0)
    {
        if ($dokter_id > 0) {
            $dokter_id = Dokter::find($dokter_id)->user->id ?? -1;
            $ruangan = Ruangan::where('poliklinik_id',$poli_id)->where('dokter_id',$dokter_id)->first();
        } else {
            $ruangan = null;
        }
        return $ruangan;
    }
}

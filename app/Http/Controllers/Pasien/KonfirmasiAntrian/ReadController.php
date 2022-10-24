<?php

namespace App\Http\Controllers\Pasien\KonfirmasiAntrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\MesinAntrianPasien;
use App\Models\Pasien\PasienPembayaran;
use App\Models\RawatJalan\DokterJadwal;
use App\Models\Pasien\Pasien;
use Carbon\Carbon;

class ReadController extends Controller
{
    public function getAntrian($request)
    {
        $start = Carbon::createFromFormat('d/m/Y', $request->start_date)->startOfDay();
        $end = Carbon::createFromFormat('d/m/Y', $request->end_date)->endOfDay();
        
        $antrian = MesinAntrianPasien::with(['dokter', 'poliklinik'])->whereBetween('created_at', [$start, $end])->where('loket_id', $request->loket)->get();
        return $antrian;
    }

    public function konfirmasiPasien($id)
    {
        $pasien = Pasien::find($id);

        return $pasien;
    }

    public function mesinAntrianFind($id)
    {
        $antrian = MesinAntrianPasien::with('pasien')->find($id);
        $pasien = Pasien::where('no_rm', $antrian->no_rm)->first();

        app('App\Http\Controllers\RawatJalan\DokterJadwal\PostController')->resetTemp();
        // dd($id_poli, $jadwal);
        $jadwal = DokterJadwal::where('dokter_jadwal.poliklinik_id', $antrian->poliklinik_id)
                                ->join('dokter', function ($join) use($antrian){
                                    $join->on('dokter.id', '=', 'dokter_jadwal.dokter_id');
                                    $join->where('dokter.id', $antrian->dokter_id);
                                })
                                ->whereNull('dokter_jadwal.changed_at')
                                ->select('dokter_jadwal.id')
                                ->first();

        $data['antrian']    = $antrian;
        $data['pasien']     = $pasien;
        $data['jadwal']     = $jadwal;

        return $data;
    }

    public function metodePembayaran($id)
    {   
        $data = PasienPembayaran::with(['perusahaan','perusahaan.tipe','kelas'])->whereNotNull('kelas_id')->where('pasien_id',$id)->get();
        return $data;
    }
}

<?php

namespace App\Http\Controllers\Pasien\Antrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\MesinAntrianPasien;
use App\Models\Pasien\Pasien;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\DokterJadwal;
use App\User;
use Carbon\Carbon;
use DB;

class PostController extends Controller
{
    public function pasienLama(Request $request)
    {
        $hari = Carbon::today()->dayOfWeek;
        $tanggal = (bool)strtotime($request->tanggal_lahir);
        if ($tanggal) {
            $tgl_lahir = Carbon::parse($request->tanggal_lahir)->format('Y-m-d');
            $pasien = app('App\Http\Controllers\RawatJalan\PermintaanRujuk\ReadController')->getTujuanRujuk($request->no_rm, $tgl_lahir, 'mesin-antrian');
            $poliklinik = DokterJadwal::where(function ($q) use ($hari) {
                                    $q->where('dokter_jadwal.hari_order', $hari);
                                })
                                ->join('dokter', function ($join) {
                                    $join->on('dokter.id', '=', 'dokter_jadwal.dokter_id');
                                })
                                ->join('poliklinik', 'poliklinik.id', '=', 'dokter_jadwal.poliklinik_id')
                                ->distinct('poliklinik.id')
                                ->select('poliklinik.*')
                                ->orderBy('poliklinik.name')
                                ->get();
            $dokter = User::where('profesi', 1)->get();
            $data['poliklinik'] = $poliklinik;
            $data['dokter'] = $dokter;
            $data['pasien'] = $pasien;
            $data['status'] = 1;
        }

        if(empty($pasien)) {
            $data['status'] = 0;
            if ($tanggal) $data['msg'] = 'Data pasien tidak ditemukan';
            else $data['msg'] = 'Format tanggal salah';
        }

        return json_encode($data);
    }

    public function print(Request $request)
    {
        DB::connection('patients')->beginTransaction();
        try {
            $antrian = app('App\Http\Controllers\Pasien\Antrian\CreateController')->create($request);
            $data['status'] = 1;
            $data['antrian'] = $antrian;

            DB::connection('patients')->commit();
        } catch (\Exception $e) {
            DB::connection('patients')->rollBack();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            
            $data['status'] = -1;
            $data['message'] = 'Antrian Gagal Ditambahkan';
        }
        return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers\Pasien\Antrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Poliklinik;
use App\Models\Pasien\MesinAntrianPasien;
use App\Models\Pasien\PengaturanLoket;
use App\Models\RawatJalan\DokterJadwal;
use App\Models\RawatJalan\Transaksi;
use App\User;
use DNS1D;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    public function antrian()
    {
        $user_roles = \Auth::user();
        $hak_akses  = app('App\Http\Controllers\Admin\HakAkses\ReadController')->getBySlug("admin-mesin-antrian");
        $data['allowed_access'] =  0;
        if(!empty($user_roles->hak_akses->where('hak_akses_id',$hak_akses->id)->first())){
            $data['allowed_access'] =  1;
        }
        

        return view('pasien.mesin-antrian.index', $data);
    }

    public function pasienLama()
    {
        $user_roles = \Auth::user();
        $hak_akses  = app('App\Http\Controllers\Admin\HakAkses\ReadController')->getBySlug("admin-mesin-antrian");
        if(empty($user_roles->hak_akses->where('hak_akses_id',$hak_akses->id)->first())){
            return abort(404);
        }

        $poli = Poliklinik::all();
        $dokter = User::where('profesi', 1)->get();
        $data['poliklinik'] = $poli;
        $data['dokter'] = $dokter;
        $data['barcode_dummy'] = DNS1D::getBarcodePNG(123456, "C128",3,30);
        return view('pasien.mesin-antrian.pasien-lama', $data);
    }

    public function getDokter($id_poli)
    {
        $datenow = Carbon::today()->toDateString();
        $hari = Carbon::today()->dayOfWeek;
        
        $jadwal = DokterJadwal::where('dokter_jadwal.poliklinik_id', $id_poli)
                        ->where(function ($q) use ($hari) {
                            $q->where('dokter_jadwal.hari_order', $hari);
                        })
                        ->join('dokter', function ($join) {
                            $join->on('dokter.id', '=', 'dokter_jadwal.dokter_id');
                        })
                        ->select('dokter_jadwal.jam_buka','dokter_jadwal.jam_tutup','dokter.id', 'dokter.name', 'dokter_jadwal.id as id_jadwal', 'dokter.kuota_offline', 'dokter_jadwal.is_video')
                        ->groupBy('id_jadwal')->get();
                                
        $dokter_jadwal_id = $jadwal->pluck('id_jadwal');

        $antrian_transaksi = Transaksi::select(['dokter_jadwal_id', DB::raw('COUNT(id) AS jobs_count')])
            ->whereNotNull('dokter_jadwal_id')
            ->where('is_online', 0)
            ->where('status', '>=', 0)
            ->whereIn('dokter_jadwal_id', $dokter_jadwal_id)
            ->whereDate('ordered_at', $datenow)
            ->groupBy('dokter_jadwal_id')
            ->pluck('jobs_count', 'dokter_jadwal_id');

        foreach ($jadwal as $key => $item) {
            $item->jobs_count = ($antrian_transaksi[$item->id_jadwal] ?? 0);
        }
        return response()->json($jadwal);
    }

    public function pasienBaru()
    {
        $user_roles = \Auth::user();
        $hak_akses  = app('App\Http\Controllers\Admin\HakAkses\ReadController')->getBySlug("admin-mesin-antrian");
        if(empty($user_roles->hak_akses->where('hak_akses_id',$hak_akses->id)->first())){
            return abort(404);
        }
        
        return view('pasien.mesin-antrian.pasien-baru');
    }

    public function printBarcode(Request $request, $no_rm)
    {
        if ($request->loket) {
            $data['loket'] = PengaturanLoket::where('id', $no_rm)->first();
            $data['antrian'] = MesinAntrianPasien::with('loket')->where('loket_id', $no_rm)->latest()->first();
            $data['barcode'] = DNS1D::getBarcodePNG('pasien_baru', "C128",3,30);
        }else {
            $antrian = MesinAntrianPasien::where('no_rm', $no_rm)->latest()->first();
            $dokter = User::where('id', $antrian->dokter_id)->first();
            $data['dokter'] = $dokter;
            $data['barcode'] = DNS1D::getBarcodePNG($no_rm, "C128",3,30);
        }

        return response()->json($data);
    }
}

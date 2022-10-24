<?php

namespace App\Http\Controllers\Pasien\PengaturanLoket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PengaturanLoket;
use App\Models\Pasien\MesinAntrianPasien;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\Dokter;
use App\Models\Kasus\RujukLuar;
use App\Models\Pasien\PasienPembayaran;
use App\User;
use Carbon\Carbon;

class ReadController extends Controller
{
    public function getLoket()
    {
        $loket = PengaturanLoket::all();

        return $loket;
    }

    public function getEdit($id)
    {
        $loket = PengaturanLoket::find($id);

        return $loket;
    }

    public function cekAntrian($request)
    {
        $req_no_rm = $request->no_rm;
        $req_dokter = $request->dokter;
        $req_poliklinik = $request->poliklinik;
        $req_pembayaran = $request->pembayaran;
        $failed_auto_sep = (bool) $request->failed_auto_sep;
        $date_now = Carbon::today()->toDateString();
        if ($req_no_rm) {
            $pasien = Pasien::where('no_rm', $req_no_rm)->first();
            $jenis_jenjang = $pasien->tni_pangkat->jenis_jenjang->id ?? null;
            $pembayaran = PasienPembayaran::find($req_pembayaran)->perusahaan->type ?? null;
            
            if (empty($pasien) || empty($pembayaran)) return null;

            $antrian_query = MesinAntrianPasien::whereDate('created_at', '=', $date_now);
            $antrian = with(clone $antrian_query);
            $loket = null;

            // Tunai
            if($pembayaran == 4){
                $loket = PengaturanLoket::where('jenis_pasien', 3)->get(); //TUNAI
                error_log('Pembayaran Tunai.');
            }
            // BPJS
            elseif($pembayaran == 1){
                if (isset($jenis_jenjang) || !empty($pasien->wali->is_anggota)) {
                    if($failed_auto_sep){
                        $loket = PengaturanLoket::where('jenis_pasien', 6)->get();
                        error_log('Pembayaran Loket TNI.');
                    }elseif ($jenis_jenjang == 1 || $jenis_jenjang == 2) {
                        $loket = PengaturanLoket::where('jenis_pasien', 5)->get();
                        error_log('Pembayaran Pangkat TNI 1 dan 2.');
                    }else{
                        $loket = PengaturanLoket::where('jenis_pasien', 4)->get();
                        error_log('Pembayaran Pangkat TNI lebih dari 2.');
                    }
                }else{
                    $loket = PengaturanLoket::where('jenis_pasien', 1)->get();
                    error_log('Pembayaran Pasien Lama.');
                }
            }else{
                $loket = PengaturanLoket::where('jenis_pasien', 1)->get();
                error_log('Pembayaran Pasien Lama.');
            }

            if ($loket->isEmpty()) {
                $loket = PengaturanLoket::where('jenis_pasien', 1)->get();
                if ($loket->isEmpty()) {
                    $loket = PengaturanLoket::get();
                }
            }
            
            $antrian = $antrian->whereIn('loket_id', $loket->pluck('id'))
            ->select('loket_id', \DB::raw("COUNT(id) AS jumlah"))
            ->groupBy('loket_id')->pluck('jumlah', 'loket_id')->toArray();

            $last_count = 0;
            $loket_current = null;
            foreach ($loket as $item) {
                $this_count = $antrian[$item->id] ?? 0;
                if ($last_count > $this_count) {
                    $loket_current = $item;
                }
                $last_count = $this_count;
            }

            $loket_current = $loket_current ?? $loket->first();
            $dokter = Dokter::where('id', $req_dokter)->first();
            $poliklinik = Poliklinik::where('id', $req_poliklinik)->first();

            $data['no_rm'] = $req_no_rm;
            $data['nama_pasien'] = $pasien->name;
            $data['dokter'] = $dokter->name;
            $data['poliklinik'] = $poliklinik->name;
            $data['loket'] = $loket_current->nama_loket;
            $data['jumlah_pasien'] = ($antrian[$loket_current->id] ?? 0) + 1;
            return $data;
        }
    }
}

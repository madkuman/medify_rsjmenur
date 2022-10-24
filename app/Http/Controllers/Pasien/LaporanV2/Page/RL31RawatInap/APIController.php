<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL31RawatInap;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterSIRSTempatTidurJenis;
use Carbon\Carbon;
use DB;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
        $total = MasterSIRSTempatTidurJenis::count();
        return json_encode([
            'status' => 200,
            'data' => $total,
        ]);
    }

    public function getData(Request $request)
    {
        // dd($request->all());
        $array_data = [];
        $take = $request->data_per_fetch;
        $skip = $request->data_fetched ?? null;
        $jenis_layanan_sirs      = MasterSIRSTempatTidurJenis::take($take);
        if($skip)
            $jenis_layanan_sirs = $jenis_layanan_sirs->skip($skip);
        $jenis_layanan_sirs = $jenis_layanan_sirs->get();

        $tahun_transaksi = $request->tanggal_transaksi ?? DATE('Y');
        // dd($jenis_layanan_sirs);
        $index = $request->data_fetched;
        foreach ($jenis_layanan_sirs as $key => $value) {
            $tanggal_pasien_awal_tahun_start = Carbon::createFromDate(($tahun_transaksi - 1))->startOfYear();
            $tanggal_pasien_awal_tahun_end   = Carbon::createFromDate(($tahun_transaksi - 1))->endOfYear();
            $tanggal_pasien_masuk_start      = Carbon::createFromDate($tahun_transaksi)->startOfYear();
            $tanggal_pasien_masuk_end        = Carbon::createFromDate($tahun_transaksi)->endOfYear();
            $jumlah_pasien_awal_tahun = app(\App\Http\Controllers\RawatJalan\Transaksi\ReadController::class)->getJumlahPasienBySirs($tanggal_pasien_awal_tahun_start, $tanggal_pasien_awal_tahun_end, $value->id, [] , true);
            // dd(
            //     $tanggal_pasien_awal_tahun_start,
            //     $tanggal_pasien_awal_tahun_end,
            //     $tanggal_pasien_masuk_start,
            //     $tanggal_pasien_masuk_end,
            // );
            $eager = [
                'pasien_detail',
                'kasus.status_krs',
                'kasus.kelas',
            ];
            $pasien_masuk          = app(\App\Http\Controllers\RawatJalan\Transaksi\ReadController::class)->getJumlahPasienBySirs($tanggal_pasien_masuk_start, $tanggal_pasien_masuk_end, $value->id, $eager);
            $pasien_keluar_hidup   = 0;
            $less_48               = 0;
            $more_48               = 0;
            $jumlah_lama_rawat     = 0;
            $pasien_akhir_tahun    = 0;
            $jumlah_hari_perawatan = 0;
            $VVIP                  = 0;
            $VIP_I                 = 0;
            $VIP_II                = 0;
            $VIP_III               = 0;
            $BIASA                 = 0;
            $KELAS_KHUSUS          = 0;
            // dd($jumlah_pasien_awal_tahun, $pasien_masuk);
            foreach ($pasien_masuk as $key => $item) {
                // dd($item);
                $waktu_masuk_ranap = Carbon::parse($item->waktu_masuk_ranap);
                $waktu_keluar_ranap = Carbon::parse($item->waktu_keluar_ranap);
                $jumlah_lama_rawat += $waktu_masuk_ranap->diff($waktu_keluar_ranap)->days;
                if(($item->kasus->status_krs->slug ?? null) != 'meninggal'){
                    $pasien_keluar_hidup++;
                }else{
                    $pasien_meninggal  = Carbon::parse($item->pasien->death_at);
                    $waktu_meninggal   = $pasien_meninggal->diffInHours($waktu_masuk_ranap);

                    if($waktu_meninggal >= 48)
                        $more_48++;
                    else
                        $less_48++;
                }
                
                if($item->nama_kelas_sirs == 'Biasa')
                    $BIASA++;
                else if($item->nama_kelas_sirs == 'VIP I')
                    $VIP_I++;
                else if($item->nama_kelas_sirs == 'VIP II')
                    $VIP_II++;
                else if($item->nama_kelas_sirs == 'VIP III')
                    $VIP_III++;
                else if($item->nama_kelas_sirs == 'VVIP')
                    $VVIP++;
                else
                    $KELAS_KHUSUS++;
                
            }
            $index++;
            $array_data[] = [
                'kode_rs'               => '',
                'kode_provinsi'         => '',
                'kab_kota'              => '',
                'nama_rs'               => config('app.name'),
                'tahun'                 => $request->tahun_transaksi ?? Carbon::parse(now())->format('Y'),
                'no'                    => $index,
                'jenis_layanan'         => $value->nama,
                'pasien_awal_tahun'     => $jumlah_pasien_awal_tahun,
                'pasien_masuk'          => $pasien_masuk->count(),
                'pasien_keluar_hidup'   => $pasien_keluar_hidup,
                'less_48'               => $less_48,
                'more_48'               => $more_48,
                'jumlah_lama_rawat'     => $jumlah_lama_rawat,
                'pasien_akhir_tahun'    => $pasien_akhir_tahun,
                'jumlah_hari_perawatan' => $jumlah_hari_perawatan,
                'VVIP'                  => $VVIP,
                'VIP_I'                 => $VIP_I,
                'VIP_II'                => $VIP_II,
                'VIP_III'               => $VIP_III,
                'BIASA'                 => $BIASA,
                'KELAS_KHUSUS'          => $KELAS_KHUSUS,
            ];
        }
        
		return json_encode([
			'status' => 200,
			'data'   => $array_data,
            'next_year' => $tahun_transaksi+1
		]);



    }
}

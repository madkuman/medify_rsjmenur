<?php

namespace App\Http\Controllers\Pasien\Laporan;

use App\Models\Hospital\MasterStatusPulang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\DTD;
use App\Models\RawatInap\Transaksi as TransaksiRawatInap;
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;
use App\Models\IGD\Transaksi as TransaksiIGD;
use Carbon\Carbon;

class LaporanKematianController extends Controller
{
    public function get($start,$end,$lokasi)
    {
        $pasien=null;
        $meninggal = MasterStatusPulang::where('slug','meninggal')->first()->id;
        if ($lokasi=='rj') {
            $query = TransaksiRawatJalan::whereBetween('waktu_pemeriksaan',[$start,$end])->whereNotNull('kasus_id')->with(['kasus.pasien','kasus.pembayaran','kasus.identitas','kasus.diagnosis','kasus.diagnosis.icd10'])->distinct()->get()->sortBy('kasus.krs_at');
            foreach ($query as $transaksi) {
                if ($transaksi->kasus->krs_status == $meninggal) {
                    $sebab_icd10 = null;
                    if (!empty($transaksi->kasus->diagnosis)) {
                        foreach ($transaksi->kasus->diagnosis as $diagnosis) {
                            $nama_icd10 = $diagnosis->icd10->code_icd.' '.$diagnosis->icd10->long_desc;
                            $sebab_icd10[] = $nama_icd10;
                        }
                    }
                    $pasien[] = [
                        'nama' => $transaksi->kasus->identitas->nama,
                        'umur' => $transaksi->pasien->age,
                        'alamat' => $transaksi->kasus->identitas->alamat,
                        'mrs' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->kasus->created_at)->toDateString(),
                        'tgl_meninggal' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->kasus->krs_at)->toDateString(),
                        'jam' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->kasus->krs_at)->toTimeString(),
                        'sebab' => $sebab_icd10,
                    ];

                }    
            }
        }
        if ($lokasi=='igd') {
            $query = TransaksiIGD::whereBetween('waktu_masuk',[$start,$end])->whereNotNull('kasus_id')->with(['kasus.pasien','kasus.pembayaran','kasus.identitas','kasus.diagnosis','kasus.diagnosis.icd10'])->distinct()->get()->sortBy('kasus.krs_at');

            foreach ($query as $pIdx => $transaksi) {
                if ($transaksi->kasus->krs_status == $meninggal) {
                    $sebab_icd10 = null;
                    if (!empty($transaksi->kasus->diagnosis)) {
                        foreach ($transaksi->kasus->diagnosis as $diagnosis) {
                            $nama_icd10 = $diagnosis->icd10->code_icd.' '.$diagnosis->icd10->long_desc;
                            $sebab_icd10[] = $nama_icd10;
                        }
                    }
                    $pasien[] = [
                        'nama' => $transaksi->kasus->identitas->nama,
                        'umur' => $transaksi->pasien->age,
                        'alamat' => $transaksi->kasus->identitas->alamat,
                        'mrs' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->kasus->created_at)->toDateString(),
                        'tgl_meninggal' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->kasus->krs_at)->toDateString(),
                        'jam' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->kasus->krs_at)->toTimeString(),
                        'sebab' => $sebab_icd10,
                    ];
                    
                }    
            }
        }
        if ($lokasi=='ri') {
            $query = TransaksiRawatInap::whereBetween('kedatangan_at',[$start,$end])->whereNotNull('kasus_id')->with(['kasus.pasien','kasus.pembayaran','kasus.identitas','kasus.diagnosis','kasus.diagnosis.icd10'])->distinct()->get()->sortBy('kasus.krs_at');

            foreach ($query as $transaksi) {
                if ($transaksi->kasus->krs_status == $meninggal) {
                    $sebab_icd10 = null;
                    if (!empty($transaksi->kasus->diagnosis)) {
                        foreach ($transaksi->kasus->diagnosis as $diagnosis) {
                            $nama_icd10 = $diagnosis->icd10->code_icd.' '.$diagnosis->icd10->long_desc;
                            $sebab_icd10[] = $nama_icd10;
                        }
                    }
                    $pasien[] = [
                        'nama' => $transaksi->kasus->identitas->nama,
                        'umur' => $transaksi->pasien->age,
                        'alamat' => $transaksi->kasus->identitas->alamat,
                        'mrs' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->kasus->created_at)->toDateString(),
                        'tgl_meninggal' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->kasus->krs_at)->toDateString(),
                        'jam' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->kasus->krs_at)->toTimeString(),
                        'sebab' => $sebab_icd10,
                    ];

                }    
            }
        }
        if ($lokasi=='all') {
            $query = Kasus::whereBetween('created_at',[$start,$end])->where('krs_status',$meninggal)->with(['pasien','pembayaran','identitas','diagnosis','diagnosis.icd10'])->orderBy('krs_at', 'asc')->distinct()->get();
            foreach ($query as $transaksi) {
                $sebab_icd10 = null;
                if (!empty($transaksi->diagnosis)) {
                    foreach ($transaksi->diagnosis as $diagnosis) {
                        $nama_icd10 = $diagnosis->icd10->code_icd.' '.$diagnosis->icd10->long_desc;
                        $sebab_icd10[] = $nama_icd10;
                    }
                }
                $pasien[] = [
                    'nama' => $transaksi->identitas->nama,
                    'umur' => ($transaksi->pasien->age ?? '-'),
                    'alamat' => $transaksi->identitas->alamat,
                    'mrs' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->created_at)->toDateString(),
                    'tgl_meninggal' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->krs_at)->toDateString(),
                    'jam' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->krs_at)->toTimeString(),
                    'sebab' => $sebab_icd10,
                ];

            }
        }

        if($lokasi == 'rj') $lokasi = 'Rawat Jalan';
        else if($lokasi == 'ri') $lokasi = 'Rawat Inap';
        else if($lokasi == 'igd') $lokasi = 'IGD';
        else  $lokasi = 'Semua';

        $data['laporan'] = $pasien;
        $data['start'] = $start;
        $data['end'] = $end;
        $data['lokasi'] = $lokasi;

        return $data;
    }
}

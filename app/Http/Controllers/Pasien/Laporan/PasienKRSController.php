<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\DTD;
use App\Models\RawatInap\Transaksi as TransaksiRawatInap;
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;
use App\Models\IGD\Transaksi as TransaksiIGD;
use Carbon\Carbon;

class PasienKRSController extends Controller
{
    public function get($start_date,$end_date,$lokasi)
    {
        // dd($start,$end,$lokasi);
        $pasien=null;

        if ($lokasi=='rj') {
        	$kasus = Kasus::whereBetween('krs_at',[$start_date,$end_date])->pluck('id')->toArray();
            $query = TransaksiRawatJalan::whereIn('kasus_id', $kasus)->with(['kasus.pasien','kasus.pembayaran.perusahaan','kasus.pembayaran.kelas','kasus.identitas','kasus.diagnosis','kasus.diagnosis.icd10','kasus.tindakan_icd9','kasus.lokasi.lokasi','kasus.admin.user'])->groupBy('kasus_id')->get();

            foreach ($query as $transaksi) {
                $sebab_icd10 = null;
                $tindakan_icd9 = null;
                if (!empty($transaksi->kasus->diagnosis)) {
                    foreach ($transaksi->kasus->diagnosis as $diagnosis) {
                        $nama_icd10 = $diagnosis->icd10->code_icd.' '.$diagnosis->icd10->long_desc;
                        $sebab_icd10[] = $nama_icd10;
                    }
                }
                if (!empty($transaksi->kasus->tindakan_icd9)) {
                	foreach ($transaksi->kasus->tindakan_icd9 as $tindakan) {
                		$tindakan_icd9[] = $tindakan->desc;
                    }
                }
                //dd($sebab_icd10);
                $pasien[] = [
                    'nama' => $transaksi->kasus->identitas->nama,
                    'no_rm' => $transaksi->kasus->pasien->no_rm,
                    'alamat' => $transaksi->kasus->identitas->alamat,
                    'jenis_bayar' => $transaksi->kasus->pembayaran->perusahaan->nama,
                    'kelas_bayar' => $transaksi->kasus->kelas->nama,
                    'no_asuransi' => $transaksi->kasus->pembayaran->no_asuransi,
                    'no_sep' => (!empty($transaksi->kasus->active_sep->no_sep)) ? $transaksi->kasus->active_sep->no_sep : '-',
                    'lokasi' => $transaksi->kasus->lokasi->lokasi->nama,
                    'dpjp' => (!empty($transaksi->kasus->admin)) ? $transaksi->kasus->admin->user->name : '-',
                    'diagnosis' => $sebab_icd10,
                    'tindakan' => $tindakan_icd9,
                    'mrs_at' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->kasus->created_at)->toDateString(),
                    'krs_at' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->kasus->krs_at)->toDateString(),
                    'krs_status' => $transaksi->kasus->status_krs->nama,
                    'krs_alasan' => $transaksi->kasus->alasan_krs->nama,
                    'phone' => $transaksi->kasus->pasien->phone,
                    'wali_phone' => $transaksi->kasus->pasien->wali->phone,
                    'wali_name' => $transaksi->kasus->pasien->wali->name,
                ];
            }
        }
        if ($lokasi=='igd') {
        	$kasus = Kasus::whereBetween('krs_at',[$start_date,$end_date])->pluck('id')->toArray();
            $query = TransaksiIGD::whereIn('kasus_id', $kasus)->with(['kasus.pasien','kasus.pembayaran.perusahaan','kasus.pembayaran.kelas','kasus.identitas','kasus.diagnosis','kasus.diagnosis.icd10','kasus.tindakan_icd9','kasus.lokasi.lokasi','kasus.admin.user'])->groupBy('kasus_id')->get();

            foreach ($query as $pIdx => $transaksi) {
                $sebab_icd10 = null;
                $tindakan_icd9 = null;
                if (!empty($transaksi->kasus->diagnosis)) {
                    foreach ($transaksi->kasus->diagnosis as $diagnosis) {
                        $nama_icd10 = $diagnosis->icd10->code_icd.' '.$diagnosis->icd10->long_desc;
                        $sebab_icd10[] = $nama_icd10;
                    }
                }
                if (!empty($transaksi->kasus->tindakan_icd9)) {
                	foreach ($transaksi->kasus->tindakan_icd9 as $tindakan) {
                		$tindakan_icd9[] = $tindakan->desc;
                    }
                }
                //dd($sebab_icd10);
                $pasien[] = [
                    'nama' => $transaksi->kasus->identitas->nama,
                    'no_rm' => $transaksi->kasus->pasien->no_rm,
                    'alamat' => $transaksi->kasus->identitas->alamat,
                    'jenis_bayar' => $transaksi->kasus->pembayaran->perusahaan->nama,
                    'kelas_bayar' => $transaksi->kasus->kelas->nama,
                    'no_asuransi' => $transaksi->kasus->pembayaran->no_asuransi,
                    'no_sep' => (!empty($transaksi->kasus->active_sep->no_sep)) ? $transaksi->kasus->active_sep->no_sep : '-',
                    'lokasi' => $transaksi->kasus->lokasi->lokasi->nama,
                    'dpjp' => (!empty($transaksi->kasus->admin)) ? $transaksi->kasus->admin->user->name : '-',
                    'diagnosis' => $sebab_icd10,
                    'tindakan' => $tindakan_icd9,
                    'mrs_at' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->kasus->created_at)->toDateString(),
                    'krs_at' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->kasus->krs_at)->toDateString(),
                    'krs_status' => $transaksi->kasus->status_krs->nama,
                    'krs_alasan' => $transaksi->kasus->alasan_krs->nama,
                    'phone' => $transaksi->kasus->pasien->phone,
                    'wali_phone' => $transaksi->kasus->pasien->wali->phone,
                    'wali_name' => $transaksi->kasus->pasien->wali->name,
                ];
            }
        }
        if ($lokasi=='ri') {
        	$kasus = Kasus::whereBetween('krs_at',[$start_date,$end_date])->pluck('id')->toArray();
            $query = TransaksiRawatInap::whereIn('kasus_id', $kasus)->with(['kasus.pasien','kasus.pembayaran.perusahaan','kasus.pembayaran.kelas','kasus.identitas','kasus.diagnosis','kasus.diagnosis.icd10','kasus.tindakan_icd9','kasus.lokasi.lokasi','kasus.admin.user'])->groupBy('kasus_id')->get();

            foreach ($query as $transaksi) {
                $sebab_icd10 = null;
                $tindakan_icd9 = null;
                if (!empty($transaksi->kasus->diagnosis)) {
                    foreach ($transaksi->kasus->diagnosis as $diagnosis) {
                        $nama_icd10 = $diagnosis->icd10->code_icd.' '.$diagnosis->icd10->long_desc;
                        $sebab_icd10[] = $nama_icd10;
                    }
                }
                if (!empty($transaksi->kasus->tindakan_icd9)) {
                	foreach ($transaksi->kasus->tindakan_icd9 as $tindakan) {
                		$tindakan_icd9[] = $tindakan->desc;
                    }
                }
                //dd($sebab_icd10);
                $pasien[] = [
                    'nama' => $transaksi->kasus->identitas->nama,
                    'no_rm' => $transaksi->kasus->pasien->no_rm,
                    'alamat' => $transaksi->kasus->identitas->alamat,
                    'jenis_bayar' => $transaksi->kasus->pembayaran->perusahaan->nama,
                    'kelas_bayar' => $transaksi->kasus->kelas->nama,
                    'no_asuransi' => $transaksi->kasus->pembayaran->no_asuransi,
                    'no_sep' => (!empty($transaksi->kasus->active_sep->no_sep)) ? $transaksi->kasus->active_sep->no_sep : '-',
                    'lokasi' => $transaksi->kasus->lokasi->lokasi->nama,
                    'dpjp' => (!empty($transaksi->kasus->admin)) ? $transaksi->kasus->admin->user->name : '-',
                    'diagnosis' => $sebab_icd10,
                    'tindakan' => $tindakan_icd9,
                    'mrs_at' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->kasus->created_at)->toDateString(),
                    'krs_at' => Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->kasus->krs_at)->toDateString(),
                    'krs_status' => $transaksi->kasus->status_krs->nama,
                    'krs_alasan' => $transaksi->kasus->alasan_krs->nama,
                    'phone' => $transaksi->kasus->pasien->phone,
                    'wali_phone' => $transaksi->kasus->pasien->wali->phone,
                    'wali_name' => $transaksi->kasus->pasien->wali->name,
                ];
            }
        }
        if ($lokasi=='all') {
            $query = Kasus::whereBetween('krs_at',[$start_date,$end_date])->with(['pasien','pembayaran','pembayaran.perusahaan','pembayaran.kelas','identitas','diagnosis','diagnosis.icd10','tindakan_icd9','lokasi.lokasi','admin.user'])->distinct()->get();
            
            foreach ($query as $kasus) {
                $sebab_icd10 = null;
                $tindakan_icd9 = null;
                if (!empty($kasus->diagnosis)) {
                    foreach ($kasus->diagnosis as $diagnosis) {
                        $nama_icd10 = $diagnosis->icd10->code_icd.' '.$diagnosis->icd10->long_desc;
                        $sebab_icd10[] = $nama_icd10;
                    }
                }
                if (!empty($kasus->tindakan_icd9)) {
                	foreach ($kasus->tindakan_icd9 as $tindakan) {
                		$tindakan_icd9[] = $tindakan->desc;
                    }
                }
                //dd($sebab_icd10);
                $pasien[] = [
                    'nama' => $kasus->identitas->nama,
                    'no_rm' => $kasus->pasien->no_rm,
                    'alamat' => $kasus->identitas->alamat,
                    'jenis_bayar' => $kasus->pembayaran->perusahaan->nama,
                    'kelas_bayar' => $kasus->kelas->nama,
                    'no_asuransi' => $kasus->pembayaran->no_asuransi,
                    'no_sep' => (!empty($kasus->active_sep->no_sep)) ? $kasus->active_sep->no_sep : '-',
                    'lokasi' => $kasus->lokasi->lokasi->nama,
                    'dpjp' => (!empty($kasus->admin)) ? $kasus->admin->user->name : '-',
                    'diagnosis' => $sebab_icd10,
                    'tindakan' => $tindakan_icd9,
                    'mrs_at' => Carbon::createFromFormat('Y-m-d H:i:s', $kasus->created_at)->toDateString(),
                    'krs_at' => Carbon::createFromFormat('Y-m-d H:i:s', $kasus->krs_at)->toDateString(),
                    'krs_status' => $kasus->status_krs->nama,
                    'krs_alasan' => $kasus->alasan_krs->nama,
                    'phone' => $kasus->pasien->phone,
                    'wali_phone' => $kasus->pasien->wali->phone,
                    'wali_name' => $kasus->pasien->wali->name,
                ];
            }
        }
        return $pasien;
    }
}

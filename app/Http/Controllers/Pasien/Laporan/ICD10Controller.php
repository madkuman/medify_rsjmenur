<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\DTD;
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;
use App\Models\RawatJalan\LaporanTransaksi as LaporanTransaksiRJ;
use App\Models\RawatInap\LaporanTransaksi as LaporanTransaksiRI;
use App\Models\IGD\LaporanTransaksi as LaporanTransaksiIGD;
use App\Models\RawatInap\LaporanTransaksiDiagnosis as LaporanTransaksiDxRI;
use App\Models\RawatJalan\LaporanTransaksiDiagnosis as LaporanTransaksiDxRJ;
use App\Models\IGD\LaporanTransaksiDiagnosis as LaporanTransaksiDxIGD;
use DB;

class ICD10Controller extends Controller
{
    static protected $ranap = "ri";
    static protected $ralan = "rj";
    static protected $igd = "igd";

    public function get($data)
    {
        $tujuan = $data['tujuan'];
        $date_start = $data['start'];
        $date_end = $data['end'];
        $icd10 = $data['icd10'];
        $array_with = ['laporan_transaksi.pasien','laporan_transaksi.kasus.lokasi.lokasi','icd10','dtd','laporan_transaksi.diagnosis.icd10'];
        switch ($tujuan) {
            case self::$ralan:
                if($icd10 == 'all') $query = LaporanTransaksiDxRJ::query();
                else $query = LaporanTransaksiDxRJ::whereIn('icd10_id',$icd10);

                $trans = $query->whereHas('laporan_transaksi', function($query) use ($date_start,$date_end){
                    $query->whereBetween('waktu_pemeriksaan', [$date_start, $date_end]);
                })->with($array_with)->groupBy('kasus_id')->get();
                break;
            case self::$ranap:
                if($icd10 == 'all') $query = LaporanTransaksiDxRI::query();
                else $query = LaporanTransaksiDxRI::whereIn('icd10_id',$icd10);

                $trans = $query->whereHas('laporan_transaksi', function($query) use ($date_start,$date_end){
                    $query->whereBetween('kedatangan_at', [$date_start, $date_end]);
                })->with($array_with)->groupBy('kasus_id')->get();
                break;
            case self::$igd:
                if($icd10 == 'all') $query = LaporanTransaksiDxIGD::query();
                else $query = LaporanTransaksiDxIGD::whereIn('icd10_id',$icd10);

                $trans = $query->whereHas('laporan_transaksi', function($query) use ($date_start,$date_end){
                    $query->whereBetween('waktu_masuk', [$date_start, $date_end]);
                })->with($array_with)->groupBy('kasus_id')->get();
                break;
            default:
                if($icd10 == 'all') $query = LaporanTransaksiDxRJ::query();
                else $query = LaporanTransaksiDxRJ::whereIn('icd10_id',$icd10);

                $rj = $query->whereHas('laporan_transaksi', function($query) use ($date_start,$date_end){
                    $query->whereBetween('waktu_pemeriksaan', [$date_start, $date_end]);
                })->with($array_with)->groupBy('kasus_id')->get();

                if($icd10 == 'all') $query = LaporanTransaksiDxRI::query();
                else $query = LaporanTransaksiDxRI::whereIn('icd10_id',$icd10);

                $ri = $query->whereHas('laporan_transaksi', function($query) use ($date_start,$date_end){
                    $query->whereBetween('kedatangan_at', [$date_start, $date_end]);
                })->with($array_with)->groupBy('kasus_id')->get();

                if($icd10 == 'all') $query = LaporanTransaksiDxIGD::query();
                else $query = LaporanTransaksiDxIGD::whereIn('icd10_id',$icd10);

                $igd =  $query->whereHas('laporan_transaksi', function($query) use ($date_start,$date_end){
                    $query->whereBetween('waktu_masuk', [$date_start, $date_end]);
                })->with($array_with)->groupBy('kasus_id')->get();

                $trans = $rj->merge($ri);
                $trans = $trans->merge($igd);
                break;
        }
        return $trans;
    }
}

<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\DTD;
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;
use App\Models\RawatJalan\LaporanTransaksi as LaporanTransaksiRJ;
use App\Models\Pasien\PembayaranPerusahaanType;
use DB;

class DiagnosisJenisPasienController extends Controller
{
    public function diagnosis($layanan,$date_start,$date_end)
    {
        $time_parameter = $this->getTimeParameter($layanan);
        $db = $this->getDBConnection($layanan);

        $jenis_px = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getGroupLaporan();

       $query = '';
       foreach ($jenis_px as $code => $item) {
           $query.= "
            SELECT ltd.`dtd_id`, COUNT(1) AS total, '".$code."' AS code
            FROM 
                `laporan_transaksi` lt,
                `laporan_transaksi_diagnosis` ltd
            WHERE 
                lt.`kasus_id` = ltd.`kasus_id`
                AND ".$time_parameter." >= '".$date_start."'
                AND ".$time_parameter." <= '".$date_end."'
                AND perusahaan_pembayaran_id IN (".implode(',', $item).")
            GROUP BY ltd.`dtd_id`
            UNION";
        }
        $query = substr($query, 0, -5);
        $data = DB::connection($db)->select($query);

        $merge_transaksi = [];
        foreach($data as $item)
        {
            $merge_transaksi[$item->dtd_id][$item->code] = $item->total;
        }
        $dtds = DTD::all();
        $return['transaksi'] = $merge_transaksi;
        $return['dtds'] = $dtds;
        $return['layanan'] = $this->getLayananName($layanan);
        $return['perusahaan_tipe'] = PembayaranPerusahaanType::get();

        return $return;
    }

    private function getLayananName($layanan)
    {
        if($layanan == 'ri') return 'RAWAT INAP';
        elseif($layanan == 'rj') return 'RAWAT JALAN';
        elseif($layanan == 'igd') return 'IGD';
    }

    private function getTimeParameter($layanan)
    {
        if($layanan == 'ri') return 'krs_at';
        elseif($layanan == 'rj') return 'waktu_pemeriksaan';
        elseif($layanan == 'igd') return 'waktu_masuk';
    }
    private function getDBConnection($layanan)
    {
        if($layanan == 'ri') return 'rawatinap';
        elseif($layanan == 'rj') return 'rawatjalan';
        elseif($layanan == 'igd') return 'igd';
    }
}

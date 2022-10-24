<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\DTD;
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;
use App\Models\RawatJalan\LaporanTransaksi as LaporanTransaksiRJ;
use DB;

class DiagnosisMeninggal extends Controller
{
    public function diagnosis($date_start,$date_end)
    {
        $grup = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getGroupLaporan();
        $jenis_px['tni_al'] = $grup[0];
        $jenis_px['pns_al'] = $grup[1];
        $jenis_px['kel_al'] = $grup[2];
        $jenis_px['non_al'] = array_merge($grup[3],$grup[4],$grup[5],$grup[6],$grup[7],$grup[8]);
        $jenis_px['purna'] = $grup[13];
        $jenis_px['anh'] = $grup[14];
        $jenis_px['mandiri'] = $grup[12];
        $jenis_px['pbi'] = $grup[15];
        $jenis_px['umum'] = $grup[9];
        $jenis_px['kerjasama'] = array_merge($grup[10],$grup[11]);
       $query = '';
       foreach ($jenis_px as $code => $item) {
           $query.= "
            SELECT ltd.`dtd_id`, COUNT(1) AS total, '".$code."' AS code
            FROM 
                `laporan_transaksi` lt,
                `laporan_transaksi_diagnosis` ltd,
                `".config('app.db_name')."_patients`.`pasien` p
            WHERE 
                lt.`kasus_id` = ltd.`kasus_id`
                AND waktu_pemeriksaan >= '".$date_start."'
                AND waktu_pemeriksaan <= '".$date_end."'
                AND perusahaan_pembayaran_id IN (".implode(',', $item).")
                and lt.`pasien_id` = p.id
                and p.death at is not null
            GROUP BY ltd.`dtd_id`
            UNION";
        }
        $query = substr($query, 0, -5);
        $data = DB::connection('rawatjalan')->select($query);
        // $query = '';
        // foreach ($jenis_px as $code => $item) {
        //    $query.= "
        //     SELECT ltd.`dtd_id`, COUNT(1) AS total, '".$code."' AS code
        //     FROM 
        //         `laporan_transaksi` lt,
        //         `laporan_transaksi_diagnosis` ltd
        //     WHERE 
        //         lt.`kasus_id` = ltd.`kasus_id`
        //         AND krs_at >= '".$date_start."'
        //         AND krs_at <= '".$date_end."'
        //         AND perusahaan_pembayaran_id IN (".implode(',', $item).")
        //     GROUP BY ltd.`dtd_id`
        //     UNION";
        // }
        // $query = substr($query, 0, -5);
        // $data = DB::connection('rawatinap')->select($query);

        // $merge_transaksi = [];
        // foreach($data as $item)
        // {
        //     $merge_transaksi[$item->dtd_id][$item->code] = $item->total;
        // }

        $merge_transaksi = [];
        foreach($data as $item)
        {
            $merge_transaksi[$item->dtd_id][$item->code] = $item->total;
        }     
        $dtds = DTD::all();
        $return['transaksi'] = $merge_transaksi;
        $return['dtds'] = $dtds;
        return $return;
    }
}

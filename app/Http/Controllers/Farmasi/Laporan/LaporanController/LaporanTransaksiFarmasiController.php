<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ResepDetail;
use DB;

class LaporanTransaksiFarmasiController extends Controller
{
    public function getData($data)
    {
        $tanggal_awal = $data['tanggal_awal'];
        $tanggal_akhir = $data['tanggal_akhir'];
        $farmasi_ids = $data['farmasi_ids'];
        $item_template_ids = $data['item_template_ids'];
        $lokasi_ids = $data['lokasi_ids'];
        $jenis_resep = $data['jenis_resep'];
        $no_rm = $data['no_rm'];
        $asuransi_tipe_id = $data['asuransi_tipe_id'];

        $query_data['tanggal_awal'] = $tanggal_awal->startOfDay()->format('Y-m-d H:i:s');
        $query_data['tanggal_akhir'] = $tanggal_akhir->startOfDay()->format('Y-m-d H:i:s');
        
        $farmasi_id_text = implode(",",$farmasi_ids);
        $query_data['farmasi'] = "AND transaksi_obat.farmasi_id IN ($farmasi_id_text)";

        $lokasi_id_text = implode(",",$lokasi_ids);
        $query_data['lokasi'] = "AND transaksi_obat.lokasi_id IN ($lokasi_id_text)";
        
        $item_template_ids_text = implode(",",$item_template_ids);
        $query_data['item_template'] = "AND item_template.id IN ($item_template_ids_text)";
        
        $asuransi_tipe_id_text = implode(",",$asuransi_tipe_id);
        $query_data['asuransi'] = "AND pembayaran_perusahaan.type IN ($asuransi_tipe_id_text)";
        
        $query_data['is_racikan']  = "";
        if($jenis_resep == "0") $query_data['is_racikan'] = "AND transaksi_obat.is_racikan = 0";
        else if($jenis_resep == "1") $query_data['is_racikan'] = "AND transaksi_obat.is_racikan = 1";
        
        $query_data['no_rm']  = "";
        if(!empty($no_rm)) $query_data['no_rm'] = "AND pasien.no_rm = ".$no_rm;

        $data = $this->getQuery($query_data);
        return $data;
        
    }

    

    private function getQuery($query_data)
    {
        $db_name = config('app.db_name');
        $query = "
        
        SELECT 
            COALESCE(users.name, transaksi_obat.dokter_nama) AS dokter_nama,
            pasien.no_rm,
            lokasi.nama AS lokasi_nama,
            pembayaran_perusahaan.nama AS asuransi_nama,
            resep_detail.id AS resep_detail_id,
            resep_detail.nama_obat,
            resep_detail.jumlah,
            IFNULL(resep_detail.hari7,0) as hari7,
            IFNULL(resep_detail.hari23,0) as hari23,
            IFNULL(resep_detail.subtotal / resep_detail.jumlah,0) AS harga_jual,
            IFNULL(resep_detail.subtotal * 100 / (100 + resep_detail.laba) / resep_detail.jumlah,0) AS hpp,
            transaksi_obat.id as transaksi_obat_id,
            IFNULL(item_template.retriksi_bpjs_jumlah,0) as retriksi_bpjs
        FROM resep_detail 
        LEFT JOIN resep ON resep.id = resep_detail.resep_id 
        LEFT JOIN `transaksi_obat` ON `transaksi_obat`.resep_final = resep.id 
        LEFT JOIN `".$db_name."_patients`.pasien ON pasien.id = transaksi_obat.pasien_id 
        LEFT JOIN `".$db_name."_patients`.pasien_pembayaran ON pasien_pembayaran.id = transaksi_obat.metode_pembayaran_id 
        LEFT JOIN `".$db_name."_patients`.`pembayaran_perusahaan` ON pasien_pembayaran.perusahaan_id = pembayaran_perusahaan.id
        LEFT JOIN `".$db_name."`.`lokasi` ON lokasi.id = transaksi_obat.lokasi_id
        LEFT JOIN items_farmasi ON items_farmasi.id = resep_detail.obat_id
        LEFT JOIN item_template ON item_template.id = items_farmasi.item_template_id 
        LEFT JOIN `".$db_name."`.users ON users.id = transaksi_obat.dokter_id
        WHERE transaksi_obat.created_at >= '".$query_data['tanggal_awal']."'
        AND transaksi_obat.created_at <= '".$query_data['tanggal_akhir']."'
        AND transaksi_obat.paid_at is not null
        and transaksi_obat.deleted_at is null
        ".$query_data['lokasi']."
        ".$query_data['farmasi']."
        ".$query_data['asuransi']."
        ".$query_data['item_template']."
        ".$query_data['is_racikan']."
        ".$query_data['no_rm']."
        ORDER BY transaksi_obat.id";
        $data_result = DB::connection('farmasi')->select($query);
        return $data_result;
    }
}

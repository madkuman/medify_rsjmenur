<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LaporanRealisaiPengadaanController extends Controller
{
    public function getData($data)
    {
        $tanggal_awal = $data['tanggal_awal'];
        $tanggal_akhir = $data['tanggal_akhir'];
        $item_template_ids = $data['item_template_ids'];

        $item_template_ids_text = implode(",",$item_template_ids);
        $query_data['item_template'] = "AND item_template.id IN ($item_template_ids_text)";
        $query_data['tanggal_awal'] = $tanggal_awal->startOfDay()->format('Y-m-d H:i:s');
        $query_data['tanggal_akhir'] = $tanggal_akhir->startOfDay()->format('Y-m-d H:i:s');
        $data = $this->getQuery($query_data);
        return $data;
        
    }

    public function getQuery($query_data)
    {
        $query = "SELECT 
                item_template.id AS item_template_id,
                item_template.nama AS nama_item,
                item_template.satuan as satuan,
                item_template.harga,
                table_2.total_pengadaan AS jml,
                table_2.total_pengadaan * item_template.harga AS total_harga
            FROM item_template
            LEFT JOIN (
            SELECT 
                item_template.id AS item_template_id,
                SUM(log_pengadaan.jumlah) AS total_pengadaan,
                item_template.harga
            FROM item_template
            LEFT JOIN items_farmasi ON items_farmasi.item_template_id = item_template.id
            LEFT JOIN items ON items.item_farmasi_id = items_farmasi.id
            LEFT JOIN log_pengadaan ON log_pengadaan.item_id = items.id
            WHERE log_pengadaan.created_at >= '".$query_data['tanggal_awal']."'
            AND log_pengadaan.created_at <= '".$query_data['tanggal_akhir']."'
            ".$query_data['item_template']."
            GROUP BY item_template.id) table_2 ON table_2.item_template_id = item_template.id
        ";
        
        $data_result = DB::connection('farmasi')->select($query);
        return $data_result;
    }

}

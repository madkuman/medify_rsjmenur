<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use App\Models\Farmasi\ItemsTemplate;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LaporanPenggunaanObatController extends Controller
{
    public function get($request)
    {
        $triwulan = $request->triwulan;
        $tahun = $request->tahun;
        $date_start = Carbon::parse((($triwulan-1)*3+1).'/1/'.$tahun)->startOfMonth();
        $date_end = $date_start->copy()->addMonth(2)->endOfMonth();

        $item_templates = ItemsTemplate::whereHas('kategori_item', function($q1){
            $q1->select('item_template_id','kategori_id')->whereHas('detail_kategori', function($q2){
                $q2->select('id','slug')->where('slug','=','obat');
            });
        })->orderBy('nama')->get();
        $stok_log = $this->stokLog($date_start,$date_end,$item_templates);
        $item_templates = $item_templates->groupBy('id');
        $item_template_fornas = ItemsTemplate::whereHas('kategori_item', function($q1){
            $q1->select('item_template_id','kategori_id')->whereHas('detail_kategori', function($q2){
                $q2->select('id','slug')->where('slug','=','fornas');
            });
        })->get()->pluck('id')->toArray();

        $item_template=[];
        foreach ($stok_log as $item)
        {
                if (isset($item_template[$item->item_template_id])) {
                    $item_template[$item->item_template_id]['pemakaian_rj_jkn'] += (int)$item->pemakaian_rj_jkn;
                    $item_template[$item->item_template_id]['pemakaian_rj_non_jkn'] += (int)$item->pemakaian_rj_non_jkn;
                    $item_template[$item->item_template_id]['pemakaian_ri_jkn'] += (int)$item->pemakaian_ri_jkn;
                    $item_template[$item->item_template_id]['pemakaian_ri_non_jkn'] += (int)$item->pemakaian_ri_non_jkn;
                } else {
                    $item_template[$item->item_template_id]['data'] = $item_templates[$item->item_template_id];
                    $item_template[$item->item_template_id]['nama'] = $item->nama;
                    $item_template[$item->item_template_id]['satuan'] = $item->satuan;

                    if (in_array($item->item_template_id, $item_template_fornas)) {
                        $item_template[$item->item_template_id]['fornas'] = 'Ya';
                    } else {
                        $item_template[$item->item_template_id]['fornas'] = 'Tidak';
                    }
                    $item_template[$item->item_template_id]['pemakaian_rj_jkn'] = (int)$item->pemakaian_rj_jkn;
                    $item_template[$item->item_template_id]['pemakaian_rj_non_jkn'] = (int)$item->pemakaian_rj_non_jkn;
                    $item_template[$item->item_template_id]['pemakaian_ri_jkn'] = (int)$item->pemakaian_ri_jkn;
                    $item_template[$item->item_template_id]['pemakaian_ri_non_jkn'] = (int)$item->pemakaian_ri_non_jkn;
            }
        }
        $new_data = $item_template;

        return $new_data;
    }

    private function stokLog($start_date,$end_date,$item_templates)
    {
        $item_template_ids = $item_templates->pluck('id')->toArray();
        $query_item_template = '';
        if(count($item_template_ids) > 0)
        {
            $item_template_ids_implode = implode(",", $item_template_ids);
            $query_item_template = "AND item_template_id IN ($item_template_ids_implode)";
        }

        $sql_date_start = $start_date->copy()->startOfDay()->format('Y-m-d H:i:s');
        $sql_date_end = $end_date->copy()->endOfDay()->format('Y-m-d H:i:s');
        $lokasi_rj = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('rawat-jalan')->pluck('id')->toArray();
        $lokasi_igd = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('igd')->pluck('id')->toArray();
        $lokasi_rj = array_merge($lokasi_rj,$lokasi_igd);
        $lokasi_ri = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('rawat-inap')->pluck('id')->toArray();
        $lokasi_rj = implode(',',$lokasi_rj);
        $lokasi_ri = implode(',',$lokasi_ri);
        $perusahaan_jkn = "AND pp.perusahaan_id IN (1,2,3,4,5,7,8,10,11)";
        $perusahaan_non_jkn = "AND pp.perusahaan_id IN (6,9,15)";

        /*NOTE
        QUERY BERDASARKAN GROUP BY ITEMS
        KALO MINTA DIUBAH KE GROUP BY TEMPLATE
        TINGGAL DIUBAH DI BLADE
        */
        $query =
            "

            SELECT 
                item_template.nama,
                item_template.satuan,
                table2.item_id AS item_id,
                table2.item_template_id,
                pemakaian_rj_jkn,
                pemakaian_ri_jkn,
                pemakaian_rj_non_jkn,
                pemakaian_ri_non_jkn
            FROM 
            (
                SELECT 
                    items_table.item_id AS item_id,
                    items_table.item_template_id AS item_template_id,
                    IFNULL(laporan_range.jumlah_min_rj_jkn,0) AS pemakaian_rj_jkn,
                    IFNULL(laporan_range.jumlah_min_rj_non_jkn,0) AS pemakaian_rj_non_jkn,
                    IFNULL(laporan_range.jumlah_min_ri_jkn,0) AS pemakaian_ri_jkn,
                    IFNULL(laporan_range.jumlah_min_ri_non_jkn,0) AS pemakaian_ri_non_jkn
                    
                FROM 
                    (
                        SELECT table_items_farmasi_list.item_id, item_template_id FROM
                        (
                            SELECT items.id AS item_id, items_farmasi.item_template_id, items.jumlah AS stok, items_farmasi.harga, kadaluarsa
                            FROM items_farmasi,items
                            WHERE items.item_farmasi_id = items_farmasi.id
                            $query_item_template
                        )table_items_farmasi_list    
                    ) items_table
                    LEFT JOIN
                    (
                        SELECT id, ROUND(SUM(jumlah_min_rj_jkn),2) AS jumlah_min_rj_jkn, ROUND(SUM(jumlah_min_rj_non_jkn),2) AS jumlah_min_rj_non_jkn, ROUND(SUM(jumlah_min_ri_jkn),2) AS jumlah_min_ri_jkn,ROUND(SUM(jumlah_min_ri_non_jkn),2) AS jumlah_min_ri_non_jkn FROM 
                        (
                            SELECT  i.id, SUM(ld.jumlah) AS jumlah_min_rj_jkn, 0 AS jumlah_min_rj_non_jkn,0 AS jumlah_min_ri_jkn,0 AS jumlah_min_ri_non_jkn
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r, ".config('app.db_name')."_patients.pasien_pembayaran pp
                            WHERE  i.id = ld.item_id
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND d.metode_pembayaran_id = pp.id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND d.lokasi_id IN($lokasi_rj)
                            $perusahaan_jkn
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id

                            UNION ALL
                            
                            SELECT  i.id, 0 AS jumlah_min_rj_jkn, 0 AS jumlah_min_rj_non_jkn, SUM(ld.jumlah) AS jumlah_min_ri_jkn,0 AS jumlah_min_ri_non_jkn
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r, ".config('app.db_name')."_patients.pasien_pembayaran pp
                            WHERE  i.id = ld.item_id
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND d.metode_pembayaran_id = pp.id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND d.lokasi_id IN($lokasi_ri)
                            $perusahaan_jkn
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id
                            
                            UNION ALL
                            
                            SELECT  i.id, 0 AS jumlah_min_rj_jkn, SUM(ld.jumlah) AS jumlah_min_rj_non_jkn,0 AS jumlah_min_ri_jkn,0 AS jumlah_min_ri_non_jkn
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r, ".config('app.db_name')."_patients.pasien_pembayaran pp
                            WHERE  i.id = ld.item_id
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND d.metode_pembayaran_id = pp.id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND d.lokasi_id IN($lokasi_rj)
                            $perusahaan_non_jkn
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id
                            
                            UNION ALL
                            
                            SELECT  i.id, 0 AS jumlah_min_rj_jkn, 0 AS jumlah_min_rj_non_jkn,0 AS jumlah_min_ri_jkn, SUM(ld.jumlah) AS jumlah_min_ri_non_jkn
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r, ".config('app.db_name')."_patients.pasien_pembayaran pp
                            WHERE  i.id = ld.item_id
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND d.metode_pembayaran_id = pp.id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND d.lokasi_id IN($lokasi_ri)
                            $perusahaan_non_jkn
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id
                            
                        ) hasil
                        GROUP BY id
                    ) laporan_range
                    ON items_table.item_id = laporan_range.id
            ) table2,
            item_template
            WHERE item_template.id = item_template_id
            ORDER BY item_template.nama    
        ";
        $stok_log = DB::connection('farmasi')->select($query);
        return $stok_log;
    }

}

<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\ItemsKategori;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\SumberDana;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LaporanBpkSumberDanaController extends Controller
{
    public function get($request)
    {
        $tahun = $request->tahun;
        $start_date = Carbon::parse($tahun.'-01-01')->startOfYear();
        $end_date = $start_date->copy()->endOfYear();
        $sumber_dana = SumberDana::find($request->sumber_dana_id);

        $item_template_ids = array_unique(ItemsKategori::where('kategori_id',$sumber_dana->kategori_id)->get()->pluck('item_template_id')->toArray());
        $farmasi_ids = Farmasi::pluck('id')->toArray();
        $items = $this->stokLog($farmasi_ids,$start_date,$end_date,$item_template_ids);
        $new_data = [];
        $last_item = '';
        foreach ($items as $item){
            if($last_item != $item->nama){
                $new_data[$item->nama]['nama'] = $item->nama;
                $new_data[$item->nama]['harga'] = $item->harga;
                $new_data[$item->nama]['stok_awal'] = $item->stok_awal;
                $new_data[$item->nama]['masuk'] = $item->penerimaan;
                $new_data[$item->nama]['keluar'] = $item->pemakaian;
                $new_data[$item->nama]['penyesuaian'] = $item->penyesuaian;
                $new_data[$item->nama]['retur'] = $item->retur_range;
                $new_data[$item->nama]['pemakaian'] = $item->transaksi_range;
                $new_data[$item->nama]['sisa'] = $item->stok_akhir;
                $last_item = $item->nama;
            }else{
                $new_data[$item->nama]['stok_awal'] += $item->stok_awal;
                $new_data[$item->nama]['masuk'] += $item->penerimaan;
                $new_data[$item->nama]['keluar'] += $item->pemakaian;
                $new_data[$item->nama]['penyesuaian'] += $item->penyesuaian;
                $new_data[$item->nama]['retur'] += $item->retur_range;
                $new_data[$item->nama]['pemakaian'] += $item->transaksi_range;
                $new_data[$item->nama]['sisa'] += $item->stok_akhir;
            }
        }
        $data['data'] = $new_data;
        $data['tahun'] = $tahun;
        $data['sumber_dana'] = $sumber_dana;
        return $data;
    }

    private function stokLog($farmasi_ids,$start_date,$end_date,$item_template_ids)
    {
        $query_item_template = '';
        if(count($item_template_ids) > 0)
        {
            $item_template_ids_implode = implode(",", $item_template_ids);
            $query_item_template = "AND item_template_id IN ($item_template_ids_implode)";
        }
        $farmasi_ids_implode = implode(",", $farmasi_ids);

        $check = Carbon::now()->between($start_date,$end_date);
        if($check)
        {
            $query_stok_akhir = '+ pemakaian_akhir - penerimaan_akhir + penyesuaian_pemakaian_akhir - penyesuaian_penerimaan_akhir';
            $query_stok_awal = '- penerimaan_akhir + pemakaian_akhir  + pemakaian_range - penerimaan_range - penyesuaian_penerimaan_akhir + penyesuaian_pemakaian_akhir  + penyesuaian_pemakaian_range - penyesuaian_penerimaan_range';
        }
        else
        {
            $query_stok_akhir = '+ pemakaian_akhir - penerimaan_akhir + penyesuaian_pemakaian_akhir - penyesuaian_penerimaan_akhir';
            $query_stok_awal = '- penerimaan_akhir + pemakaian_akhir  + pemakaian_range - penerimaan_range - penyesuaian_penerimaan_akhir + penyesuaian_pemakaian_akhir  + penyesuaian_pemakaian_range - penyesuaian_penerimaan_range';
        }

        $sql_date_start = $start_date->copy()->startOfDay()->format('Y-m-d H:i:s');
        $sql_date_end = $end_date->copy()->endOfDay()->format('Y-m-d H:i:s');
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
                table2.kadaluarsa,
                table2.item_id AS item_id,
                table2.item_template_id,
                item_template.harga,
                table2.harga_saat_itu,
                stok_saat_ini,
                stok_saat_ini $query_stok_awal AS stok_awal,
                penerimaan_range AS penerimaan,
                pemakaian_range AS pemakaian,
                retur_range,
                transaksi_range,
                penyesuaian_penerimaan_range - penyesuaian_pemakaian_range AS penyesuaian,               
                stok_saat_ini $query_stok_akhir AS stok_akhir
            FROM 
            (
                SELECT 
                    items_table.item_id AS item_id,
                    items_table.item_template_id AS item_template_id,
                    items_table.kadaluarsa,
                    items_table.harga,
                    items_table.harga_saat_itu,
                    IFNULL(items_table.stok,0) AS stok_saat_ini,
                    IFNULL(laporan_show.jumlah_plus,0) AS retur_range,
                    IFNULL(laporan_show.jumlah_min,0) AS transaksi_range,
                    IFNULL(laporan_range.jumlah_plus,0) AS penerimaan_range, 
                    IFNULL(laporan_range.jumlah_min,0) AS pemakaian_range,
                    IFNULL(laporan_akhir.jumlah_plus,0) AS penerimaan_akhir, 
                    IFNULL(laporan_akhir.jumlah_min,0) AS pemakaian_akhir,
                    IFNULL(laporan_range.penyesuaian_jumlah_plus,0) AS penyesuaian_penerimaan_range, 
                    IFNULL(laporan_range.penyesuaian_jumlah_min,0) AS penyesuaian_pemakaian_range,
                    IFNULL(laporan_akhir.penyesuaian_jumlah_plus,0) AS penyesuaian_penerimaan_akhir, 
                    IFNULL(laporan_akhir.penyesuaian_jumlah_min,0) AS penyesuaian_pemakaian_akhir
                FROM 
                    (
                        SELECT table_items_farmasi_list.item_id, item_template_id, stok, harga, harga_saat_itu,kadaluarsa FROM
                        (
                            SELECT items.id AS item_id, items_farmasi.item_template_id, items.jumlah AS stok, items_farmasi.harga, kadaluarsa
                            FROM items_farmasi,items
                            WHERE items.item_farmasi_id = items_farmasi.id
                            AND items_farmasi.farmasi_id IN ($farmasi_ids_implode)
                            $query_item_template
                        )table_items_farmasi_list
                        LEFT JOIN
                        (
                            SELECT t1.item_id, harga_saat_itu 
                            FROM (
                                SELECT items.id AS item_id, MAX(log_pengadaan.harga_saat_itu) as harga_saat_itu, MAX(log_pengadaan.tanggal) as tanggal
                                FROM `log_pengadaan`, `items`
                                WHERE `items`.id = `log_pengadaan`.item_id
                                AND log_pengadaan.tanggal >= '$sql_date_start'
                                AND log_pengadaan.tanggal <= '$sql_date_end'
                                AND items.farmasi_id IN ($farmasi_ids_implode)
                                GROUP BY `items`.id
                                ) t1
                            JOIN (
                                SELECT items.id AS item_id, MAX(log_pengadaan.tanggal) as tanggal
                                FROM `log_pengadaan`, `items`
                                WHERE `items`.id = `log_pengadaan`.item_id
                                GROUP BY item_farmasi_id
                                ) t2
                            ON t1.item_id = t2.item_id
                            AND t1.tanggal = t2.tanggal
                        )table_item_farmasi_harga
                        ON table_items_farmasi_list.item_id = table_item_farmasi_harga.item_id
                    ) items_table
                    LEFT JOIN
                    (
                        SELECT id, ROUND(SUM(jumlah_plus),2) AS jumlah_plus, ROUND(SUM(jumlah_min),2) AS jumlah_min,  ROUND(SUM(jumlah_plus) - SUM(jumlah_min),2) AS jumlah, ROUND(SUM(penyesuaian_jumlah_plus),2) AS penyesuaian_jumlah_plus, ROUND(SUM(penyesuaian_jumlah_min),2) AS penyesuaian_jumlah_min FROM 
                        (
                            SELECT  i.id, 'transaksi' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id

                            UNION ALL
                            
                            SELECT  i.id, 'transaksi retur' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`transaksi_id` = d.`id`
                            AND i.item_farmasi_id = it.id
                            AND r.retur = 1
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at >= '$sql_date_start'
                            AND d.created_at <= '$sql_date_end'
                            AND (d.keterangan NOT IN ('Stok Opname Live','Stok Opname') OR d.keterangan IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                            WHERE d.id = ld.pengadaan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.tanggal >= '$sql_date_start'
                            AND d.tanggal <= '$sql_date_end'
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id 

                            UNION ALL

                            SELECT  i.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND d.created_at >= '$sql_date_start'
                            AND d.created_at <= '$sql_date_end'
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id 
                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND d.created_at >= '$sql_date_start'
                            AND d.created_at <= '$sql_date_end'
                            AND d.status <> -1
                            AND (d.deskripsi NOT IN ('Stok Opname Live','Stok Opname') OR d.deskripsi IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                            
                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, 0 AS jumlah_min, 0 AS jumlah_plus, SUM(ld.jumlah) AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at >= '$sql_date_start'
                            AND d.created_at <= '$sql_date_end'
                            AND d.keterangan IN ('Stok Opname Live','Stok Opname')
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                            
                            UNION ALL
                            
                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, SUM(ld.jumlah) AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND d.created_at >= '$sql_date_start'
                            AND d.created_at <= '$sql_date_end'
                            AND d.status <> -1
                            AND d.deskripsi IN ('Stok Opname Live','Stok Opname')
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id 
                        ) hasil
                        GROUP BY id
                    ) laporan_range
                    ON items_table.item_id = laporan_range.id
                    LEFT JOIN
                    (
                        SELECT id,nama, ROUND(SUM(jumlah_plus),2) AS jumlah_plus, ROUND(SUM(jumlah_min),2) AS jumlah_min,  ROUND(SUM(jumlah_plus) - SUM(jumlah_min),2) AS jumlah, ROUND(SUM(penyesuaian_jumlah_plus),2) AS penyesuaian_jumlah_plus, ROUND(SUM(penyesuaian_jumlah_min),2) AS penyesuaian_jumlah_min FROM 
                        (
                            SELECT  i.id, 'transaksi' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id

                            UNION ALL
                            
                            SELECT  i.id, 'transaksi retur' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`transaksi_id` = d.`id`
                            AND i.item_farmasi_id = it.id
                            AND r.retur = 1
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id 
                        ) hasil
                        GROUP BY id
                    ) laporan_show
                    ON items_table.item_id = laporan_show.id
                    LEFT JOIN
                    (
                        SELECT id, ROUND(SUM(jumlah_plus),2) AS jumlah_plus, ROUND(SUM(jumlah_min),2) AS jumlah_min,  ROUND(SUM(jumlah_plus) - SUM(jumlah_min),2) AS jumlah, ROUND(SUM(penyesuaian_jumlah_plus),2) AS penyesuaian_jumlah_plus, ROUND(SUM(penyesuaian_jumlah_min),2) AS penyesuaian_jumlah_min FROM 
                        (
                            SELECT  i.id, 'transaksi' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND ld.created_at > '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id
                            
                            UNION ALL
                            
                            SELECT  i.id, 'transaksi retur' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`transaksi_id` = d.`id`
                            AND i.item_farmasi_id = it.id
                            AND r.retur = 1
                            AND ld.created_at > '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id
                            
                            UNION ALL
                            
                            SELECT  i.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at > '$sql_date_end'
                            AND (d.keterangan NOT IN ('Stok Opname Live','Stok Opname') OR d.keterangan IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                            
                            UNION ALL
                            
                            SELECT  i.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                            WHERE d.id = ld.pengadaan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.tanggal > '$sql_date_end'
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id 
                            
                            UNION ALL
                            
                            SELECT  i.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND d.created_at > '$sql_date_end'
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id 
                            UNION ALL
                            
                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND d.created_at > '$sql_date_end'
                            AND d.status <> -1
                            AND (d.deskripsi NOT IN ('Stok Opname Live','Stok Opname') OR d.deskripsi IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                            
                            UNION ALL
                            
                            SELECT  i.id, 'penghapusan' nama, 0 AS jumlah_min, 0 AS jumlah_plus, SUM(ld.jumlah) AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at > '$sql_date_end'
                            AND d.keterangan IN ('Stok Opname Live','Stok Opname')
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                            
                            UNION ALL
                            
                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, SUM(ld.jumlah) AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND d.created_at > '$sql_date_end'
                            AND d.status <> -1
                            AND d.deskripsi IN ('Stok Opname Live','Stok Opname')
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id 
                        ) hasil
                        GROUP BY id
                    ) laporan_akhir
                ON items_table.item_id = laporan_akhir.id
            ) table2,
            item_template
            WHERE item_template.id = item_template_id
            ORDER BY item_template.nama

            
        ";
        $stok_log = \Illuminate\Support\Facades\DB::connection('farmasi')->select($query);
        return $stok_log;
    }

}

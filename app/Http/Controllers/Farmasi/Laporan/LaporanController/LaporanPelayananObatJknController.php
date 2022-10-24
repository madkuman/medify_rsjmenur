<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\ItemsTemplate;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LaporanPelayananObatJknController extends Controller
{
    public function get($request)
    {
        $triwulan = $request->triwulan;
        $tahun = $request->tahun;
        $date_start = Carbon::parse((($triwulan-1)*3+1).'/1/'.$tahun)->startOfMonth();
        $date_end = $date_start->copy()->addMonth(2)->endOfMonth();

        $item_template_ids = ItemsTemplate::whereHas('kategori_item', function($q1){
            $q1->select('item_template_id','kategori_id')->whereHas('detail_kategori', function($q2){
                $q2->select('id','slug')->where('slug','=','obat');
            });
        })->orderBy('nama')->get()->pluck('id')->toArray();
        $farmasi_ids = Farmasi::pluck('id')->toArray();
        $lokasi_rj = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('rawat-jalan')->pluck('id')->toArray();
        $lokasi_igd = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('igd')->pluck('id')->toArray();
        $lokasi_rj = array_merge($lokasi_rj,$lokasi_igd);
        $lokasi_ri = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('rawat-inap')->pluck('id')->toArray();
        $lokasi_rj = implode(',',$lokasi_rj);
        $lokasi_ri = implode(',',$lokasi_ri);
        $item_template_generik = ItemsTemplate::whereHas('kategori_item', function($q1){
            $q1->select('item_template_id','kategori_id')->whereHas('detail_kategori', function($q2){
                $q2->select('id','slug')->where('slug','=','generik');
            });
        })->get()->pluck('id')->toArray();
            $stok_log = $this->stokLog($farmasi_ids,$date_start,$date_end,$item_template_ids,$lokasi_rj,$lokasi_ri);
            $item_template= [];
            foreach ($stok_log as $item){
                if (isset($item_template[$item->item_template_id])) {
                    $item_template[$item->item_template_id]['rj'] += (int)$item->rj;
                    $item_template[$item->item_template_id]['ri'] += (int)$item->ri;
                    $item_template[$item->item_template_id]['stok_awal'] += (int)$item->stok_awal;
                    $item_template[$item->item_template_id]['pengadaan_real'] += (int)$item->pengadaan_real;
                } else {
                    $item_template[$item->item_template_id]['nama'] = $item->nama;
                    $item_template[$item->item_template_id]['satuan'] = $item->satuan;
                    $item_template[$item->item_template_id]['harga'] = $item->harga;
                    if (in_array($item->item_template_id, $item_template_generik)) {
                        $item_template[$item->item_template_id]['generik'] = 'generik';
                    } else {
                        $item_template[$item->item_template_id]['generik'] = 'bermerk';
                    }
                    $item_template[$item->item_template_id]['rj'] = (int)$item->rj;
                    $item_template[$item->item_template_id]['ri'] = (int)$item->ri;
                    $item_template[$item->item_template_id]['stok_awal'] = (int)$item->stok_awal;
                    $item_template[$item->item_template_id]['pengadaan_real'] = (int)$item->pengadaan_real;
                }
            }
            $data['data'] = $item_template;
            $data['date_start'] = $date_start;
            $data['date_end'] = $date_end;
            $data['year'] = $tahun;
        return $data;
    }

    private function stokLog($farmasi_ids,$start_date,$end_date,$item_template_ids,$lokasi_rj,$lokasi_ri)
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
        $perusahaan_jkn = "AND pp.perusahaan_id IN (1,2,3,4,5,7,8,10,11)";
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
                penyesuaian_penerimaan_range - penyesuaian_pemakaian_range AS penyesuaian,               
                stok_saat_ini $query_stok_akhir AS stok_akhir,
                rj AS rj,
                ri AS ri,
                pengadaan_real AS pengadaan_real
                
            FROM 
            (
                SELECT 
                    items_table.item_id AS item_id,
                    items_table.item_template_id AS item_template_id,
                    items_table.kadaluarsa,
                    items_table.harga,
                    items_table.harga_saat_itu,
                    IFNULL(items_table.stok,0) AS stok_saat_ini,
                    IFNULL(laporan_range.jumlah_plus,0) AS penerimaan_range, 
                    IFNULL(laporan_range.jumlah_min,0) AS pemakaian_range,
                    IFNULL(laporan_akhir.jumlah_plus,0) AS penerimaan_akhir, 
                    IFNULL(laporan_akhir.jumlah_min,0) AS pemakaian_akhir,
                    IFNULL(laporan_range.penyesuaian_jumlah_plus,0) AS penyesuaian_penerimaan_range, 
                    IFNULL(laporan_range.penyesuaian_jumlah_min,0) AS penyesuaian_pemakaian_range,
                    IFNULL(laporan_akhir.penyesuaian_jumlah_plus,0) AS penyesuaian_penerimaan_akhir, 
                    IFNULL(laporan_akhir.penyesuaian_jumlah_min,0) AS penyesuaian_pemakaian_akhir,
                    IFNULL(laporan_range.rj,0) AS rj,
                    IFNULL(laporan_range.ri,0) AS ri,
                    IFNULL(laporan_range.pengadaan_real,0) AS pengadaan_real
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
                        SELECT id, ROUND(SUM(jumlah_plus),2) AS jumlah_plus, ROUND(SUM(jumlah_min),2) AS jumlah_min,  ROUND(SUM(jumlah_plus) - SUM(jumlah_min),2) AS jumlah, ROUND(SUM(penyesuaian_jumlah_plus),2) AS penyesuaian_jumlah_plus, ROUND(SUM(penyesuaian_jumlah_min),2) AS penyesuaian_jumlah_min, ROUND(SUM(rj),2) AS rj, ROUND(SUM(ri),2) AS ri,ROUND(SUM(pengadaan_real),2) AS pengadaan_real FROM 
                        (
                            SELECT  i.id, 'transaksi' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus,0 AS ri,0 AS rj, 0 AS pengadaan_real
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
                            
                            SELECT  i.id, 'transaksi retur' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus,0 AS ri,0 AS rj, 0 AS pengadaan_real
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

                            SELECT  i.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus,0 AS ri,0 AS rj, 0 AS pengadaan_real
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

                            SELECT  i.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus,0 AS ri,0 AS rj, SUM(ld.jumlah) AS pengadaan_real
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

                            SELECT  i.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus,0 AS ri,0 AS rj, 0 AS pengadaan_real
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

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus,0 AS ri,0 AS rj, 0 AS pengadaan_real
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

                            SELECT  i.id, 'penghapusan' nama, 0 AS jumlah_min, 0 AS jumlah_plus, SUM(ld.jumlah) AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus,0 AS ri,0 AS rj, 0 AS pengadaan_real
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
                            
                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, SUM(ld.jumlah) AS penyesuaian_jumlah_plus,0 AS ri,0 AS rj, 0 AS pengadaan_real
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
                            
                            UNION ALL 
                            
                            SELECT  i.id, 'ri' nama, 0 AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus,SUM(ld.jumlah) AS ri,0 AS rj, 0 AS pengadaan_real
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r, ".config('app.db_name')."_patients.pasien_pembayaran pp
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
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
                            
                            SELECT  i.id, 'rj' nama, 0 AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus,0 AS ri,SUM(ld.jumlah) AS rj, 0 AS pengadaan_real
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r, ".config('app.db_name')."_patients.pasien_pembayaran pp
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
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
                            
                        ) hasil
                        GROUP BY id
                    ) laporan_range
                    ON items_table.item_id = laporan_range.id
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
        $stok_log = DB::connection('farmasi')->select($query);
        return $stok_log;
    }

}

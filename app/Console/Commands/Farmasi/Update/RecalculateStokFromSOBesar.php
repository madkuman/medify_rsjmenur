<?php

namespace App\Console\Commands\Farmasi\Update;

use App\Models\Farmasi\StokOpname;
use Illuminate\Console\Command;
use App\Models\Farmasi\StokLog;
use App\Models\Farmasi\LogDistribusi;
use App\Models\Farmasi\LogPengadaan;
use App\Models\Farmasi\LogPenghapusan;
use App\Models\Farmasi\LogTransaksi;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\Items;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class RecalculateStokFromSOBesar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farmasi:recalculate-stok-from-so-besar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $farmasi_list = Farmasi::where('slug','instalasi-farmasi')->get();

        try {
            foreach ($farmasi_list as $farmasi) {
                echo $farmasi->nama."\n";
                $last_so_besar = StokOpname::where('farmasi_id', $farmasi->id)->where('status',1)->where('flag',0)->with('opname_detail', 'distribusi.log', 'penghapusan.log')->orderBy('id','desc')->first();
                if ($last_so_besar) {
                    $items_farmasi = ItemsFarmasi::where('farmasi_id', $farmasi->id)->with('all_items')->get();
                    $min_date = $last_so_besar->distribusi->created_at->toDateTimeString();
                    $penghapusan_id = $last_so_besar->penghapusan->id ?? -1;
                    foreach ($items_farmasi as $item_farmasi) {
                        $so_item_farmasi = $last_so_besar->opname_detail->where('item_id', $item_farmasi->id) ?? [];
                        $in_array_items = [];
                        foreach ($so_item_farmasi as $row)
                        {
                            $item_selected = Items::where('item_farmasi_id',$item_farmasi->id)->whereDate('kadaluarsa',date('Y-m-d', strtotime($row->kadaluarsa)))->first();
                            if($item_selected) {
                                $in_array_items[$item_selected->id] = $row->jumlah;
                            }
                        }
                        foreach ($item_farmasi->all_items as $item) {
                            $max_date = Carbon::now()->toDateTimeString();
                            $item->refresh();
                            $log = "SELECT * FROM (
                            SELECT  
                            table_transaksi.id, 
                    table_transaksi.created_at, 
                    IF(table_transaksi.pasien_id IS NULL, '0', p.no_rm) nomor_rm, 
                    IF(table_transaksi.pasien_id IS NULL, 'Pasien Bebas', p.name) nama, 
                    table_transaksi.jumlah_min,
                    table_transaksi.jumlah_plus, 
                    table_transaksi.nomor_resep  
                            FROM (
                                SELECT  it.id, ld.created_at, (ld.jumlah) AS jumlah_min, IFNULL((ld.jumlah_retur), 0) AS jumlah_plus, r.nomor_resep nomor_resep, d.pasien_id
                                FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                                WHERE  i.id = ld.item_id
                                AND i.id = " . $item->id . "
                                AND ld.`resep_detail_id` = rd.`id`
                                AND rd.`resep_id` = r.`id`
                                AND r.`id` = d.`resep_final`
                                AND i.item_farmasi_id = it.id
                                AND ld.created_at > '" . $min_date . "'
                                AND ld.created_at < '" . $max_date . "'
                                AND r.`deleted_at` IS  NULL
                                AND d.deleted_at IS  NULL
                                AND ld.`deleted_at` IS  NULL
                                
                                UNION ALL
                                
                                SELECT  it.id, ld.created_at, (ld.jumlah) AS jumlah_min, IFNULL((ld.jumlah_retur), 0) AS jumlah_plus, r.nomor_resep nomor_resep, d.pasien_id
                                FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                                WHERE  i.id = ld.item_id
                                AND i.id = " . $item->id . "
                                AND ld.`resep_detail_id` = rd.`id`
                                AND rd.`resep_id` = r.`id`
                                AND r.`transaksi_id` = d.id
                                AND r.retur = 1
                                AND i.item_farmasi_id = it.id
                                AND ld.created_at > '" . $min_date . "'
                                AND ld.created_at < '" . $max_date . "'
                                AND r.`deleted_at` IS  NULL
                                AND d.deleted_at IS  NULL
                                AND ld.`deleted_at` IS  NULL
                            ) table_transaksi
                            LEFT JOIN " . config('app.db_name') . "_patients.pasien p
                            ON table_transaksi.pasien_id = p.id
        
                            UNION ALL
                            
                            SELECT  it.id, d.created_at, 0 as nomor_rm, 'Penghapusan Obat' nama, (ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, '-' nomor_resep
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND i.id = " . $item->id . "
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at > '" . $min_date . "'
                            AND d.created_at < '" . $max_date . "'
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND d.id != ".$penghapusan_id."
                            
                            UNION ALL
                            
                            SELECT  it.id, d.tanggal, 0 AS nomor_rm, 'Pengadaan Obat' nama, 0 AS jumlah_min, (ld.jumlah) AS jumlah_plus, '-' nomor_resep
                            FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                            WHERE d.id = ld.pengadaan_id
                            AND i.id = " . $item->id . "
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.tanggal > '" . $min_date . "'
                            AND d.tanggal < '" . $max_date . "'
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL 
                            
                            UNION ALL
                            
                            SELECT  it.id, ld.created_at, 0 as nomor_rm, IF(d.unit_tujuan, f.nama, 'GUDANG') nama, (ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, '-' nomor_resep
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it, farmasi f
                            WHERE d.id = ld.distribusi_id
                            AND i.id = " . $item->id . "
                            AND f.id = d.unit_tujuan
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '" . $min_date . "'
                            AND ld.created_at < '" . $max_date . "'
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND d.kategori != 'Permintaan' 
                            UNION ALL
                            
                            SELECT  it.id, ld.created_at, 0 as nomor_rm, IF(d.unit_tujuan, f.nama, 'GUDANG') nama, (ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, '-' nomor_resep
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it, farmasi f
                            WHERE d.id = ld.distribusi_id
                            AND i.id = " . $item->id . "
                            AND f.id = d.unit_tujuan
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '" . $min_date . "'
                            AND ld.created_at < '" . $max_date . "'
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND d.kategori = 'Permintaan'
                            AND d.status = 2 
                            UNION ALL
                            
                            SELECT  it.id, ld.created_at, 0 AS nomor_rm, IF(d.unit_tujuan, IF(d.unit_tujuan = d.farmasi_id, 'Stok Opname', f.nama), 'GUDANG') nama, 0 AS jumlah_min, (ld.jumlah) AS jumlah_plus, '-' nomor_resep
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it, farmasi f
                            WHERE d.id = ld.distribusi_id
                            AND i.id = " . $item->id . "
                            AND f.id = d.unit_tujuan
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '" . $min_date . "'
                            AND ld.created_at < '" . $max_date . "'
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND d.id != ".$last_so_besar->distribusi->id."
                        ) AS hasil ORDER BY created_at ASC";
                            $log = DB::connection('farmasi')->select(DB::raw($log));
                            $jumlah_plus = collect($log)->sum(function ($item) {
                                return $item->jumlah_plus;
                            });
                            $jumlah_min = collect($log)->sum(function ($item) {
                                return $item->jumlah_min;
                            });
                            $stok_setelah_so = $in_array_items[$item->id] ?? 0;
                            $jumlah = $stok_setelah_so + $jumlah_plus - $jumlah_min;
                            $item->tanggal_awal = $min_date;
                            $item->jumlah_awal = $stok_setelah_so;
                            $item->jumlah_recalculate = $jumlah;
                            $item->last_so_id = $last_so_besar->id;
//                            if($item->jumlah < 0)
//                            {
//                                $penyesuaian_log_kpenghapusan = LogPenghapusan::where('item_id',$item->id)->first();
//                                if($penyesuaian_log_penghapusan) {
//                                    if ($penyesuaian_log_penghapusan->subtotal != 0)
//                                        $harga_satuan = $penyesuaian_log_penghapusan->subtotal / $penyesuaian_log_penghapusan->jumlah;
//                                    else $harga_satuan = 0;
//                                    $penyesuaian_log_penghapusan->jumlah += $item->jumlah;
//                                    $penyesuaian_log_penghapusan->subtotal = $penyesuaian_log_penghapusan->jumlah * $harga_satuan;
//                                    $penyesuaian_log_penghapusan->save();
//                                    $item->jumlah = 0;
//                                }
//                            }
                            $item->save();
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            echo "ERROR " . $farmasi->nama . '--' . Carbon::now()->format('H:i:s') . "\n";
            dd($e);
        }
    }
}

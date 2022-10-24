<?php

namespace App\Console\Commands\Farmasi\Update;

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


class StokLogRegenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farmasi:stok-log-regenerate {start_date=0} {end_date=0}';

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
        $arguments = $this->arguments();
        $start_date = $arguments['start_date'];
        $end_date = $arguments['end_date'];

        if($start_date == 0) $start = Carbon::now()->subDay()->startOfDay();
        else $start = Carbon::createFromFormat('d-m-Y', $start_date)->startOfDay(); 

        if($end_date == 0) $end = Carbon::now()->subDay()->endOfDay();
        else $end = Carbon::createFromFormat('d-m-Y', $end_date)->endOfDay();
        
        $farmasi_list = Farmasi::all();
        echo "Start :".Carbon::now()->format('H:i:s')."\n";

        $current_date = $start->copy()->endOfDay();

        while($current_date <= $end)
        {
            try
            {
                echo $current_date->format('d-m-Y')."-- At : ".Carbon::now()->format('H:i:s')."\n";
                $stok_logs = [];
                foreach($farmasi_list as $farmasi)
                {
                    $items_farmasi = ItemsFarmasi::where('farmasi_id',$farmasi->id)->with('items_all','item_template')->get();
                    $total_count = count($items_farmasi);
                    $count = 0;
                    foreach($items_farmasi as $item_farmasi)
                    {
                        $item_farmasi_id = $item_farmasi->id;
                        $count++;
                        if($count == $total_count){
                            //echo "Progress ".$farmasi->nama."--".$count.'--'.Carbon::now()->format('H:i:s')."\n";
                        }

                        $item_template_id = $item_farmasi->item_template_id;
                        $harga = $item_farmasi->harga;
                        $items = Items::where('item_farmasi_id',$item_farmasi->id)->get();

                        foreach($items as $item)
                        {
                            $current_date_start = $current_date->copy()->startOfday();
                            $current_date_end = $current_date->copy()->endOfday();
                            $item_id = $item->id;
                            $jml_pengadaan = LogPengadaan::where('item_id',$item_id)->where('created_at','<=',$current_date_end)->sum('jumlah');
                            
                            $jml_distribusi_msk = LogDistribusi::where('item_id',$item_id)->where('created_at','<=',$current_date_end)->where('jenis',1)->where('tipe',1)->sum('jumlah');

                            $jml_distribusi_keluar = LogDistribusi::where('item_id',$item_id)->where('created_at','<=',$current_date_end)->where('jenis',1)->where('tipe',-1)->sum('jumlah');
                            
                            $jml_penghapusan = LogPenghapusan::where('item_id',$item_id)->where('created_at','<=',$current_date_end)->sum('jumlah');
                            
                            $jml_transaksi = LogTransaksi::where('item_id',$item_id)->where('created_at','<=',$current_date_end)->sum('jumlah');

                            $stok_akhir = $jml_pengadaan+$jml_distribusi_msk-$jml_distribusi_keluar-$jml_penghapusan-$jml_transaksi;

                            $jml_pengadaan_today = LogPengadaan::where('item_id',$item_id)->whereBetween('created_at',[$current_date_start,$current_date_end])->sum('jumlah');
                            
                            $jml_distribusi_msk_today = LogDistribusi::where('item_id',$item_id)->whereBetween('created_at',[$current_date_start,$current_date_end])->where('jenis',1)->where('tipe',1)->sum('jumlah');

                            $jml_distribusi_keluar_today = LogDistribusi::where('item_id',$item_id)->whereBetween('created_at',[$current_date_start,$current_date_end])->where('jenis',1)->where('tipe',-1)->sum('jumlah');
                            
                            $jml_penghapusan_today = LogPenghapusan::where('item_id',$item_id)->whereBetween('created_at',[$current_date_start,$current_date_end])->sum('jumlah');
                            
                            $jml_transaksi_today = LogTransaksi::where('item_id',$item_id)->whereBetween('created_at',[$current_date_start,$current_date_end])->sum('jumlah');

                            $stok_mutasi = $jml_pengadaan_today+$jml_distribusi_msk_today-$jml_distribusi_keluar_today-$jml_penghapusan_today-$jml_transaksi_today;

                            $stok_awal = $stok_akhir-$stok_mutasi;
                            $transaksi_today = 0;

                            if(
                                $jml_pengadaan_today > 0 ||
                                $jml_distribusi_msk_today > 0 ||
                                $jml_distribusi_keluar_today > 0 ||
                                $jml_penghapusan_today > 0 ||
                                $jml_transaksi_today > 0
                            ) $transaksi_today = 1;

                            if($stok_awal == 0 && $stok_mutasi == 0 && $transaksi_today == 0) continue;

                            $stok_log = new StokLog;
                            $stok_log->farmasi_id = $farmasi->id;
                            $stok_log->item_id = $item_id;
                            $stok_log->item_farmasi_id = $item_farmasi_id;
                            $stok_log->item_template_id = $item_template_id;
                            $stok_log->stok_awal = $stok_awal;
                            $stok_log->stok_mutasi = $stok_mutasi;
                            $stok_log->stok = $stok_akhir;
                            $stok_log->harga_jual = $harga;
                            $stok_log->harga_beli = $item->harga_saat_itu;
                            $stok_log->log_pengadaan_id = $item->log_pengadaan_id;
                            $stok_log->tanggal = $current_date;
                            $stok_log->total_transaksi = $jml_transaksi_today;
                            $stok_log->total_distribusi_masuk = $jml_distribusi_msk_today;
                            $stok_log->total_distribusi_keluar = $jml_distribusi_keluar_today;
                            $stok_log->total_penghapusan = $jml_penghapusan_today;
                            $stok_log->total_pengadaan = $jml_pengadaan_today;

                            $stok_logs[] = $stok_log->toArray();

                        }
                    }
                }

                foreach (array_chunk($stok_logs,1000) as $logs) {
                    StokLog::insert($logs);
                }
            }
            catch (\Exception $e) {
                echo "ERROR ".$farmasi->nama."--".$count.'--'.Carbon::now()->format('H:i:s')."\n";
                dd($e);
            }

            $current_date->addDay();
        }
    }
}

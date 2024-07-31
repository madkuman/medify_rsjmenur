<?php

namespace App\Console\Commands\Farmasi;

use App\Models\Farmasi\TransaksiObat;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TransaksiAdjustDikerjakanAtBerdasarkanPenyerahan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farmasi:transaksi-adjust-dikerjakan-at-berdasarkan-penyerahan {id_or_start} {end=0} {--action}';

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
    protected $action;
    public function handle()
    {
        $id_or_start = $this->argument('id_or_start');
        $end = $this->argument('end');
        $this->action = $this->option('action');

        $eager = [
            'transaksi_obat_telaah_obat_penyerahan',
            'final_detail.resep_detail.log',
        ];

        if ($end == 0 && is_numeric($id_or_start)) {
            $transaksi_obat = TransaksiObat::with($eager)->find($id_or_start);
            $this->adjust($transaksi_obat);
        } else if (!empty($end) && !empty($id_or_start)) {
            try {
                $start_date = Carbon::createFromFormat('Y-m-d', $id_or_start)->startOfDay();
                $end_date = Carbon::createFromFormat('Y-m-d', $end)->endOfDay();
            } catch (\Exception $e) {
                echo "format date harus Y-m-d";
                return 0;
            }

            $data_transaksi_obat = TransaksiObat::with($eager)->whereBetween('created_at', [$start_date, $end_date])->get();
            foreach ($data_transaksi_obat as $transaksi_obat) {
                $this->adjust($transaksi_obat);
            }
        } else {
            echo 'wrong parameter';
        }
        return 1;
    }

    function adjust($transaksi_obat)
    { 
        if (empty($transaksi_obat->dikerjakan_at) || empty($transaksi_obat->transaksi_obat_telaah_obat_penyerahan)) return false; 
        echo $transaksi_obat->id;
        echo "| dikerjakan_at:".$transaksi_obat->dikerjakan_at;
        echo "| telaah_penyerahan_at:".$transaksi_obat->transaksi_obat_telaah_obat_penyerahan->created_at;

        if ($this->action) {
            try { 
                DB::connection('farmasi')->beginTransaction();
                $telaah_penyerahan_at = $transaksi_obat->transaksi_obat_telaah_obat_penyerahan->created_at;
                $transaksi_obat->dikerjakan_at = $telaah_penyerahan_at;
                $transaksi_obat->save();
                foreach ($transaksi_obat->final_detail->resep_detail as $resep_detail) {
                    foreach ($resep_detail->log as $log_transaksi) {
                        $log_transaksi->created_at = $telaah_penyerahan_at;
                        $log_transaksi->save();
                    }
                }
                DB::connection('farmasi')->commit();
                echo '| success';
            } catch (\Exception $e) {
                DB::connection('farmasi')->rollback();
                echo '| error : '. $e->getMessage();
            }
        }
        echo "\n";
        return true;    
    }
}

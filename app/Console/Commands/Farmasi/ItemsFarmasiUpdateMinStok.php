<?php

namespace App\Console\Commands\Farmasi;

use Illuminate\Console\Command;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\StokLog;
use Carbon\Carbon;
use DB;

class ItemsFarmasiUpdateMinStok extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farmasi:items-farmasi-update-min-stok';

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
        $items = ItemsFarmasi::all();
        $date_start = Carbon::now();
        $date_end = $date_start->copy()->subDays(30);

        ItemsFarmasi::chunk(10000, function($items) use ($date_end,$date_start) {
            foreach($items as $item)
            {
                $log = StokLog::where('item_farmasi_id',$item->id)
                ->whereBetween('tanggal',[$date_end,$date_start])
                ->select([
                    DB::raw("(
                        SUM(total_distribusi_keluar)+
                        SUM(total_penghapusan)+
                        SUM(total_transaksi)) 
                        as stok_keluar"),
                    'item_farmasi_id'
                ])
                ->groupBy('item_farmasi_id')
                ->first();

                if(!empty($log->stok_keluar)){
                    $item->min_stok = $log->stok_keluar ?? 0;
                    $item->save();
                }
            }
            echo $item->id."\n";
        });
    }
}

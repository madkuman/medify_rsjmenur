<?php

namespace App\Console\Commands\RawatInap\Update;

use Illuminate\Console\Command;
use App\Models\RawatInap\Transaksi;
use Carbon\Carbon;

class TransaksiLOS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rawatinap:update-los';

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
        $now = Carbon::today();
        $transaksi = Transaksi::all();
        foreach ($transaksi as $index => $item) {
            if(empty($item->kedatangan_at)) {
                if(!empty($item->waktu_keluar)){
                    $item->los = 0;
                    $item->save();
                    continue;
                }
                else $start_time = $now;
                
            }
            else $start_time = $item->kedatangan_at;

            if(empty($item->waktu_keluar)) $end_time = $now;
            else $end_time = $item->waktu_keluar;


            $start_time = Carbon::parse($start_time);
            $end_time = Carbon::parse($end_time);

            $start_time->startOfDay();
            $end_time->endOfDay();

            $day = $start_time->diffInDays($end_time);

            $item->los = $day+1; 
            $item->save();
        }
    }
}

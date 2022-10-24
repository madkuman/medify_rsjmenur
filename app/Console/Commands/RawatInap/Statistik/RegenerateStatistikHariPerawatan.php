<?php

namespace App\Console\Commands\RawatInap\Statistik;

use Illuminate\Console\Command;
use App\Models\RawatInap\TempatTidur;
use App\Models\RawatInap\Transaksi;
use App\Models\RawatInap\StatistikHariPerawatan;
use Carbon\Carbon;

class RegenerateStatistikHariPerawatan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rawatinap:regenerate-statistik-hari-perawatan';

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
        $start_date = TempatTidur::orderBy('created_at','asc')->first()->created_at->startOfDay();
        $end_date = Carbon::today()->endOfDay();
        $current_date = $start_date->copy();

        while($current_date<$end_date){

            echo "---------------------------------\n";
            echo $current_date->copy()->format('d M Y')."\n";

            $current_day_start = $current_date->copy()->startOfDay();
            $current_day_end = $current_date->copy()->endOfDay();

            $beds = TempatTidur::withTrashed()
                ->where('created_at','<=',$current_day_end)
                ->where('is_hitung_statistik',1)
                ->where(function($q) use ($current_day_start, $current_day_end) {
                  $q->where('deleted_at','>=',$current_day_start)
                  ->orWhereNull('deleted_at');
                })
                ->get();

            echo 'Bed :'.count($beds)."\n\n";

            foreach($beds as $bed)
            {
                $transaksi = Transaksi::where('tempat_tidur_id',$bed->id)
                ->where('waktu_masuk','<=',$current_day_end)
                ->where(function($q) use ($current_day_start, $current_day_end) {
                  $q->where('waktu_keluar','>=',$current_day_start)
                  ->orWhereNull('waktu_keluar');
                })
                ->get();

                $total_transaksi = count($transaksi);
                if($total_transaksi > 0) $transaksi_id = $transaksi[$total_transaksi-1]->id;
                else $transaksi_id = null;


                $tanggal = $current_day_end->copy();
                $hari_perawatan = app('App\Http\Controllers\RawatInap\StatistikHariPerawatan\CreateController')->create($tanggal, $bed->id,$transaksi_id);
            }

            $current_date->addDay();
        }

        /*
        nge get first TT created_at

        get tempat_tidur with trashed

        for everyday as day

        get tt where created_at <= day_start and deleted_at >= day_end

        get transaksi where tt_id = tt
        and where date (waktu_masuk) <= where date (day)
        and waktu_keluar >= day_start 
        or waktu_keluar is null
        */
    }
}

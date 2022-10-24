<?php

namespace App\Console\Commands\Kasus\Update;

use Illuminate\Console\Command;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;

class LOS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kasus:update-los';

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
        $kasus = Kasus::where('tipe_ri',1)->whereNotNull('mrs_at')->get();
        foreach($kasus as $k)
        {
            $this->updateKasus($k);
        }
    }

    public function updateKasus($kasus)
    {
        $now = Carbon::today();
        if(empty($kasus->mrs_at)) $start_time = $kasus->created_at;
        else $start_time = $kasus->mrs_at;

        if(empty($kasus->krs_at)) $end_time = $now;
        else $end_time = $kasus->krs_at;


        $start_time->startOfDay();
        $end_time->endOfDay();

        $day = $start_time->diffInDays($end_time);

        $kasus->ranap_los = $day+1; //karena hari terakhir sama dia gadiitung
        $kasus->save();
    }
}

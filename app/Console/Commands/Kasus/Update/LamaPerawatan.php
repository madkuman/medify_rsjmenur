<?php

namespace App\Console\Commands\Kasus\Update;

use Illuminate\Console\Command;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;

class LamaPerawatan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kasus:update-lama-perawatan';

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
        $kasus_igd = Kasus::where('tipe_igd',1)->get();
        foreach($kasus_igd as $k)
        {
            $this->updateLamaPerawatan($k);
        }

        $kasus_ranap = Kasus::where('tipe_ri',1)->where('tipe_igd',0)->whereNotNull('mrs_at')->get();
        foreach($kasus_ranap as $k)
        {
            $this->updateLamaPerawatan($k);
        }
    }

    public function updateLamaPerawatan($kasus)
    {
        $now = Carbon::today();
        if(empty($kasus->mrs_at)) $start_time = $kasus->created_at;
        else $start_time = $kasus->mrs_at;

        if(empty($kasus->krs_at)) $end_time = $now;
        else $end_time = $kasus->krs_at;
        
        $jam = $start_time->diffInHours($end_time);
        $day = $jam/24;

        $kasus->lama_perawatan = $day;
        $kasus->save();
    }
}

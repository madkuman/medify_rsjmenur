<?php

namespace App\Console\Commands\RawatInap\Statistik;

use Illuminate\Console\Command;
use Artisan;
use Carbon\Carbon;

class RekapStatistikMingguan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rawatinap:create-statistik-mingguan';

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
        $start = Carbon::now()->subWeek()->format('d-m-Y');
        Artisan::call('rawatinap:create-statistik-main', ['type' => 'minggu','start_date' => $start]);
    }
}

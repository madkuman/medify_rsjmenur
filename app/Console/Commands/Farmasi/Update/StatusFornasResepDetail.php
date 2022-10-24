<?php

namespace App\Console\Commands\Farmasi\Update;

use Illuminate\Console\Command;
use App\Models\Farmasi\TransaksiObat;
use Carbon\Carbon;

class StatusFornasResepDetail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farmasi:update-status-fornas-resep-detail {start_id=1}';

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
        $start_id = $this->argument('start_id');
        echo "Start :".Carbon::now()->format('H:i:s')."\n";
        TransaksiObat::where('id','>=',$start_id)->chunk(100, function($transaksi)
        {
            echo "Progress ".$transaksi[0]->id.'--'.Carbon::now()->format('H:i:s')."\n";
            foreach ($transaksi as $item)
            {
                try
                {
                    $resep = app('App\Http\Controllers\Farmasi\Transaksi\EditController')->editStatus($item->id);
                }
                    catch (\Exception $e) {
                        echo $item->id."--ERROR\n";
                }
            }
        });
    }
}

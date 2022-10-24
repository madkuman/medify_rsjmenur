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


class RecalculateStok extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farmasi:recalculate-stok {--farmasi_id=} {--item_farmasi_id=}';

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
        $item_farmasi_id = $this->option('item_farmasi_id');
        $farmasi_id = $this->option('farmasi_id');
        if($farmasi_id != null){
            $farmasi_list = Farmasi::where('id',$farmasi_id)->get();
        }else {
            $farmasi_list = Farmasi::where('slug','instalasi-farmasi')->get();
        }

        try {
            foreach ($farmasi_list as $farmasi) {
                echo $farmasi->nama."\n";
                    if($item_farmasi_id != null) {
                        $items_farmasi = ItemsFarmasi::where('id', $item_farmasi_id)->get();
                    }else {
                        $items_farmasi = ItemsFarmasi::where('farmasi_id', $farmasi->id)->get();
                    }
                    foreach ($items_farmasi as $item_farmasi) {
                        app('App\Http\Controllers\Farmasi\Items\EditController')->recalculateStok($item_farmasi->id);
                    }
                }
        } catch (\Exception $e) {
            echo "ERROR " . $farmasi->nama . '--' . Carbon::now()->format('H:i:s') . "\n";
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}

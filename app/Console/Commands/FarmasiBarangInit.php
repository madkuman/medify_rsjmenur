<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\ItemsTemplate;
use App\User;
use Auth;
use DB;
use Carbon\Carbon;
use Bugsnag;

class FarmasiBarangInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farmasi:barang-init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Barang Init untuk tiap farmasi';

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
        try
        {
            $items = ItemsTemplate::all();
            $farmasies = Farmasi::all();
            foreach ($items as $item) {
                app('App\Http\Controllers\Farmasi\Items\CreateController')->createItemFarmasiAll($item, $farmasies);

                echo $item->nama." done.\n";
            }
            echo "all done.\n";
        }
        catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

    }
}

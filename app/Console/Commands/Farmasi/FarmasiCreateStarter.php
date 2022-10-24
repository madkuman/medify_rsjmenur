<?php

namespace App\Console\Commands\Farmasi;

use Illuminate\Console\Command;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\ItemsFarmasi;
use App\User;
use Auth;
use DB;
use Carbon\Carbon;
use Bugsnag;

class FarmasiCreateStarter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farmasi:create-starter {farmasi_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Barang Init untuk farmasi baru';

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
        $farmasi_id = $this->argument('farmasi_id');
        try
        {
            $items = ItemsTemplate::get();

            foreach ($items as $item) {
                if(!is_null($item->slug)) {
                    $nama = $item->slug;
                }
                else {
                    $slug = preg_replace('~[^\pL\d]+~u', '-', $item->nama);
                    $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);// transliterate
                    $slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
                    $slug = trim($slug, '-'); // trim
                    $slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
                    $slug = strtolower($slug); // lowercase
                    $slug = str_replace('%', '', $slug);
                    $nama = $slug;
                }
                $data = array(
                    'item_template_id' => $item->id,
                    'farmasi_id' => $farmasi_id,
                    'harga' => $item->harga,
                    'min_kadaluarsa' => $item->min_kadaluarsa,
                    'min_stok' => $item->min_stok,
                    'slug' => $nama."-".$farmasi_id
                );

               $insertData[] = $data;
            }
            //dd($insertData);
            
            ItemsFarmasi::insert($insertData);
        }
        catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

    }
}

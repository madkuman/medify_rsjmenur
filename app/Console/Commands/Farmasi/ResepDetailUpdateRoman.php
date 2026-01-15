<?php

namespace App\Console\Commands\Farmasi;

use App\Models\Farmasi\ResepDetail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResepDetailUpdateRoman extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farmasi:resep-detail-update-roman {--action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'melakukan update pada resep_detail.roman, karena ada bug   permintaan';

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
        $action = $this->option('action');

        $query = ResepDetail::whereHas('resep', function ($query) {
            $query->select(DB::raw(1))
                ->where('konfirmasi_permintaan_at', '!=', null);
        })->orderBy('id', 'asc');

        $limit = 100;
        $last_id = 0;
        do {
            $data = with(clone $query)->where('id', '>', $last_id)->limit($limit)->get();
            foreach ($data as $resep_detail) {
                $roman = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman((int) ceil($resep_detail->jumlah));
                if ($resep_detail->roman == $roman) {
                    continue;
                }
                echo $resep_detail->id;
                echo " ";
                echo $resep_detail->jumlah;
                echo " ";
                echo $resep_detail->roman;
                echo " -> ";
                echo $roman;
                echo "\n";
                if ($action) {
                    $resep_detail->roman = $roman;
                    $resep_detail->save();
                }
            }
            $last_id = $data->last()->id ?? 0;
        } while ($data->count() == $limit);
    }
}

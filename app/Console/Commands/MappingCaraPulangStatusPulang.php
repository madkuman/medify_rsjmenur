<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kasus\Kasus;
use App\Models\Hospital\MasterCaraPulang;
use App\Models\Hospital\MasterStatusPulang;
use Auth;
use DB;

class MappingCaraPulangStatusPulang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kasus:mapping-cara-pulang-status-pulang';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mapping value hardcode ke slug untuk cara pulang dan status pulang';

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
        Auth::loginUsingId(1);

        DB::beginTransaction();
        try {
            $kasus_krs = Kasus::whereNotNull('krs_at')->get();
            foreach ($kasus_krs as $key => $item) {

                // SET ALASAN KRS
                echo "Mapping Kasus ID ".$item->id." (Cara Pulang: ".$item->krs_alasan.")...\n";
                if ($item->krs_alasan == 'Selesai Pelayanan') {
                    $item->krs_alasan = MasterCaraPulang::where('slug', 'selesai-pelayanan')->first()->id;
                } else if ($item->krs_alasan == 'APS') {
                    $item->krs_alasan = MasterCaraPulang::where('slug', 'aps')->first()->id;
                } else if ($item->krs_alasan == 'Melarikan Diri') {
                    $item->krs_alasan = MasterCaraPulang::where('slug', 'melarikan-diri')->first()->id;
                } else if ($item->krs_alasan == 'Rujuk Rumah Sakit Lain') {
                    $item->krs_alasan = MasterCaraPulang::where('slug', 'rujuk')->first()->id;
                }


                // SET STATUS KRS
                echo "Mapping Kasus ID ".$item->id." (Status Pulang: ".$item->krs_status.")...\n";
                if ($item->krs_status == 'Sehat' || $item->krs_status == 'Sembuh') {
                    $item->krs_status = MasterStatusPulang::where('slug', 'sembuh')->first()->id;
                } else if ($item->krs_status == 'Membaik') {
                    $item->krs_status = MasterStatusPulang::where('slug', 'membaik')->first()->id;
                } else if ($item->krs_status == 'Sakit') {
                    $item->krs_status = MasterStatusPulang::where('slug', 'sakit')->first()->id;
                } else if ($item->krs_status == 'Meninggal') {
                    $item->krs_status = MasterStatusPulang::where('slug', 'meninggal')->first()->id;
                }

                $item->save();
            }

            DB::commit();

            echo "done.";
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::rollback();
        }
            
    }
}

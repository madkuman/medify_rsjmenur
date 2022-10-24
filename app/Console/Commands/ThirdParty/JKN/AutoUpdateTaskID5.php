<?php

namespace App\Console\Commands\ThirdParty\JKN;

use App\Models\RawatJalan\Transaksi;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class AutoUpdateTaskID5 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thirdparty:jkn-auto-update-task-id-5';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

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
        $this->request = app('App\Http\Controllers\ThirdParty\BPJS\JKN\RequestController');
        $now = Carbon::now();
        $data_transaksi = Transaksi::with('poliklinik')->whereNull('waktu_pemeriksaan')->whereBetween('ordered_at', [$now->copy()->startOfDay(),$now])->get();
        foreach ($data_transaksi as $transaksi) {
            try {
                echo "transaksi_id ".$transaksi->id. ' = ';
                $estimasi_per_px = $transaksi->poliklinik->interval_antrian ?? 3;
                $max_random = config('medify.third-party.jkn_online.pengali_waktu_tunggu_auto_taskid_5', 10);
                $tambahan_waktu = Carbon::parse($transaksi->ordered_at)->addMinute(rand($estimasi_per_px,$max_random));
                $arg = (object)[
                    'url' => $this->request->getUrl() . '/antrean/updatewaktu',
                    'header' => $this->request->getHeader(),
                    'params' => (new Request())->merge([
                        'kodebooking' => $transaksi->id,
                        'taskid' => 5,
                        'waktu' => (int) round($tambahan_waktu->format('Uu') / pow(10, 6 - 3)),
                    ]),
                ];

                $update_waktu_antrean = app('App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\EditController')->updateWaktuAntrean($arg->url, $arg->header, $arg->params);
                $update_waktu_antrean_data = json_decode($update_waktu_antrean);
                if($update_waktu_antrean_data->metaData->code != 500){
                    echo "success";
                    $transaksi->ordered_at = $tambahan_waktu->toDateTimeString();
                    $transaksi->save();
                }else{
                    echo "failed";
                }
            } catch (\Exception $t) {
                app(\App\Http\Controllers\Error\Handler::class)->bugsnag($t);
                echo "error";
            }
            echo "\n";
        }
    }
}

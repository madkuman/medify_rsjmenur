<?php

namespace App\Console\Commands\Thirdparty\SIRS;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class DataTempatTidurSudahPernahDiinput extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'third-party-sirs:tempat-tidur-yang-pernah-diinput';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Informasi data tempat tidur yang sudah pernah diinputkan';

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
        if(empty(config('app.sirs_id')) || empty(config('app.sirs_pass')))
        {
            return 0;
        }
        
        $headers['X-rs-id'] = config('app.sirs_id');
        $headers['X-Timestamp'] = now()->timestamp;
        $headers['X-pass'] = config('app.sirs_pass');
        $headers['Accept'] ='application/json';
        $url = config('app.sirs_url').'/fo/index.php/Fasyankes';

        $client = new Client();
        $res = $client->request('GET', $url, 
            [
                'headers' => $headers
            ]
        );
        $content = json_decode($res->getBody()->getContents());
        $data = $content->fasyankes;

        echo "\nInformasi data tempat tidur yang sudah pernah diinputkan\n";

        foreach ($data as $d) {
            echo "\n#########################################\n";
            echo "id_tt: ".$d->id_tt."\n";
            echo "tt: ".$d->tt."\n";
            echo "ruang: ".$d->ruang."\n";
            echo "kode_siranap: ".$d->kode_siranap."\n";
            echo "jumlah_ruang: ".$d->jumlah_ruang."\n";
            echo "jumlah: ".$d->jumlah."\n";
            echo "terpakai: ".$d->terpakai."\n";
            echo "prepare: ".$d->prepare."\n";
            echo "prepare_plan: ".$d->prepare_plan."\n";
            echo "kosong: ".$d->kosong."\n";
            echo "covid: ".$d->covid."\n";
            echo "id_t_tt: ".$d->id_t_tt."\n";
            echo "tglupdate: ".$d->tglupdate."\n";
            echo "#########################################\n";
        }

        echo "\nDone";
    }
}

<?php

namespace App\Console\Commands\thirdparty\sirs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use GuzzleHttp\Psr7;

class RekapPasienDirawatTanpaKomorbidDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'third-party-sirs:rekap-pasien-dirawat-tanpa-komorbid-delete {tanggal=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete jumlah pasien Covid-19 yang masih dirawat inap (tanpa komorbid) di rumah sakit per hari, format: YYYY-MM-DD';

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
        $headers['Accept'] = 'application/json';
        $url = config('app.sirs_url') . '/fo/index.php/LapV2/PasienDirawatTanpaKomorbid';

        $arguments = $this->arguments();
        $tanggal = $arguments['tanggal'];
        
        if ($tanggal == 0) {
            $tanggal = now()->format('Y-m-d');
        }

        try {
            $client = new Client();
            $res = $client->request('DELETE', $url,
                [
                    'headers' => $headers,
                    'json' => ['tanggal' => $tanggal]
                ]
            );
            $content = json_decode($res->getBody()->getContents());
            $data = $content['RekapPasienDirawatTanpaKomorbid'][0];
            
            echo $data['message'];
            echo "\nDone";
        } catch (RequestException $e) {
            $response = Psr7\str($e->getResponse());
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        } catch (\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}

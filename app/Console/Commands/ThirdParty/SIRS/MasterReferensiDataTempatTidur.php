<?php

namespace App\Console\Commands\ThirdParty\SIRS;

use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use Carbon\Carbon;

class MasterReferensiDataTempatTidur extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'third-party-sirs:master-referensi-data-tempat-tidur';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Semua data ruangan atau tempat tidur covid19';

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
        $headers['X-pass'] = config('app.sirs_pass');
        $headers['X-Timestamp'] = Carbon::now()->timestamp;
        $headers['Accept'] ='application/json';
        $url = config('app.sirs_url').'/fo/index.php/Referensi/tempat_tidur';

        try
        {
            $client = new Client();
            $res = $client->get($url, [
                    'headers' => $headers
                ]);

            echo "\n### Informasi data tempat tidur pasien covid19 ###\n\n";

            $data_sirs = json_decode($res->getBody()->getContents());
            $result = '';
            foreach ($data_sirs->tempat_tidur as $tempat_tidur) {
                $result .= "Kode TT $tempat_tidur->kode_tt\n";
                $result .= "Nama TT $tempat_tidur->nama_tt\n";
                $result .= "\n";
            }

            echo $result;
        } catch (RequestException $e) {
            $response = Psr7\str($e->getResponse());
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }catch (\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}

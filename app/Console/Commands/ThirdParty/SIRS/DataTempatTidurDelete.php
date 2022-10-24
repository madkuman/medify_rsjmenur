<?php

namespace App\Console\Commands\ThirdParty\SIRS;

use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use Carbon\Carbon;

class DataTempatTidurDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'third-party-sirs:data-tempat-tidur-delete {--id_tt=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghapus data tempat tidur berdasarkan id-tt';

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
        
        echo "Start process \n";

        $id_tt = $this->option('id_tt');
        $headers['X-rs-id'] = config('app.sirs_id');
        $headers['X-pass'] = config('app.sirs_pass');
        $headers['X-Timestamp'] = Carbon::now()->timestamp;
        $headers['Accept'] ='application/json';
        $url = config('app.sirs_url').'/fo/index.php/Fasyankes';

        $data = $this->getDataTempatTidur();

        echo "Process hapus \n";
        foreach ($data->fasyankes as $fasyankes) {
            if ($fasyankes->id_tt == $id_tt) {
                try
                {
                    $client = new Client();
                    $res = $client->request('DELETE', $url, [
                        'headers' => $headers,
                        'json' => [
                            'id_tt' => $id_tt
                        ]
                    ]);
                    $res = json_decode($res->getBody()->getContents());
                    echo $res->fasyankes[0]->message . "\n";
                } catch (RequestException $e) {
                    $response = Psr7\str($e->getResponse());
                    app('App\Http\Controllers\Error\Handler')->bugsnag($e);
                } catch (\Exception $e){
                    app('App\Http\Controllers\Error\Handler')->bugsnag($e);
                }
            }
        }
        echo "End process \n";
    }

    private function getDataTempatTidur()
    {
        $headers['X-rs-id'] = config('app.sirs_id');
        $headers['X-pass'] = config('app.sirs_pass');
        $headers['X-Timestamp'] = Carbon::now()->timestamp;
        $headers['Accept'] ='application/json';
        $url = config('app.sirs_url').'/fo/index.php/Fasyankes';

        try
        {
            $client = new Client();
            $res = $client->request('GET', $url, [
                'headers' => $headers
            ]);
            $data_sirs = json_decode($res->getBody()->getContents());

            echo "Done getting data tempat_tidur \n";
            return $data_sirs;
        } catch (RequestException $e) {
            $response = Psr7\str($e->getResponse());
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        } catch (\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}

<?php

namespace App\Console\Commands\ThirdParty\SIRS;

use Illuminate\Console\Command;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class RekapPasienMasukCovid19Delete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'third-party-sirs:rekap-pasien-masuk-covid-19-delete {date=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus data pasien masuk covid 19 dari api sirs Rekap HARIAN Format : yyyy-mm-dd';

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
        $arguments = $this->arguments();
        $date = $arguments['date'];
        echo "Date: ".$date."\n";

        $headers['X-rs-id'] = config('app.sirs_id');
        $headers['X-pass'] = config('app.sirs_pass');
        $headers['X-Timestamp'] = Carbon::now()->timestamp;
        $headers['Accept'] ='application/x-www-form-urlencoded';
        $url = config('app.sirs_url').'/fo/index.php/LapV2/PasienMasuk';

        try
        {
            $data = [
                'tanggal' => $date
            ];

            $client = new Client();
            $res = $client->request('DELETE', $url, [
                    'headers' => $headers,
                    'json' => $data
                ]);

            $content = json_decode($res->getBody()->getContents());
            return 1;
        } catch (RequestException $e) {
            $response = Psr7\str($e->getResponse());
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return 0;
        }
        catch (\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return 0;
        }
        echo "End process \n";

    }
}

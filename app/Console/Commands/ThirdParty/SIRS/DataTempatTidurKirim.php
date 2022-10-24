<?php

namespace App\Console\Commands\ThirdParty\SIRS;

use Illuminate\Console\Command;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\TempatTidur;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use Carbon\Carbon;

class DataTempatTidurKirim extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'third-party-sirs:data-tempat-tidur-kirim';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim data tempat tidur untuk covid19';

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
        if(!config('app.sirs_enable') || empty(config('app.sirs_id')) || empty(config('app.sirs_pass')))
        {
            return 0;
        }
        echo "Start process \n";

        $headers['X-rs-id'] = config('app.sirs_id');
        $headers['X-pass'] = config('app.sirs_pass');
        $headers['X-Timestamp'] = Carbon::now()->timestamp;
        $headers['Accept'] ='application/json';
        $url = config('app.sirs_url').'/fo/index.php/Fasyankes';

        try
        {
            $ruangans = Ruangan::whereNotNull('sirs_covid_19_tt_id')->get();
            $ruangan_group = Ruangan::groupBy('sirs_covid_19_tt_id')->whereNotNull('sirs_covid_19_tt_id')->get();

            foreach ($ruangan_group as $key => $ruangan) {
                $bed_jumlah[$key] = 0;
                $bed_terpakai[$key] = 0;
                foreach ($ruangans as $r) {
                    if ($r->sirs_covid_19_tt_id == $ruangan->sirs_covid_19_tt_id) {
                        $bed_jumlah[$key] += TempatTidur::where('ruangan_id', $r->id)->count();
                        $bed_terpakai[$key] += TempatTidur::where('ruangan_id', $r->id)
                                            ->whereNotNull('transaksi_id')
                                            ->whereNotNull('booking_id')
                                            ->count();
                    }
                }
                $data['id_tt'] = $ruangan->sirs_covid_19_tt_id;
                $data['jumlah_ruang'] = Ruangan::where('sirs_covid_19_tt_id', $ruangan->sirs_covid_19_tt_id)->count();
                $data['jumlah'] = $bed_jumlah[$key];
                $data['terpakai'] = $bed_terpakai[$key];

                $client = new Client();
                $res = $client->request('POST', $url, [
                            'headers' => $headers,
                            'json' => $data
                        ]);

                $content = json_decode($res->getBody()->getContents());
                echo $content->fasyankes[0]->message."\n";
            }

            echo "End process \n";
            return 1;
        } catch (RequestException $e) {
            $response = Psr7\str($e->getResponse());
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }catch (\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}

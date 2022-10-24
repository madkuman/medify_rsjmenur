<?php

namespace App\Console\Commands\ThirdParty\SIRS;

use Illuminate\Console\Command;
use App\Models\Kasus\Covid19Status;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class RekapPasienMasukCovid19Create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'third-party-sirs:rekap-pasien-masuk-covid-19-create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simpan data pasien covid 19 ke sirs';

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
        $relasi = ['kasus', 'kasus.pasien', 'kasus.lokasi', 'kasus.lokasi.lokasi', 'kasus.lokasi.lokasi.departemen'];
        $start_time = date('Y-m-d 00:00:00');
        $end_time = date('Y-m-d 23:59:59');
        $data_kasus = Covid19Status::with($relasi)
                    ->whereBetween('updated_at', [$start_time, $end_time])
                    ->groupBy('kasus_id')
                    ->get();

        $igd_suspect_l = 0;
        $igd_suspect_p = 0;
        $igd_confirm_l = 0;
        $igd_confirm_p = 0;
        $rj_suspect_l = 0;
        $rj_suspect_p = 0;
        $rj_confirm_l = 0;
        $rj_confirm_p = 0;
        $ri_suspect_l = 0;
        $ri_suspect_p = 0;
        $ri_confirm_l = 0;
        $ri_confirm_p = 0;

        foreach ($data_kasus as $key => $kasus) {

            $departemen = $kasus->kasus->lokasi->lokasi->departemen->nama;

            switch ($departemen) {
                case 'IGD':
                    // laki-laki
                    if ($kasus->kasus->pasien->gender == 1) {
                        if ($kasus->status == 'suspek') {
                            $igd_suspect_l += 1;
                        } else if ($kasus->status == 'konfirmasi') {
                            $igd_confirm_l += 1;
                        }
                    } 
                    // perempuan
                    else {
                        if ($kasus->status == 'suspek') {
                            $igd_suspect_p += 1;
                        } else if ($kasus->status == 'konfirmasi') {
                            $igd_confirm_p += 1;
                        }
                    }
                    break;
                case 'Rawat Jalan':
                    // laki-laki
                    if ($kasus->kasus->pasien->gender == 1) {
                        if ($kasus->status == 'suspek') {
                            $rj_suspect_l += 1;
                        } else if ($kasus->status == 'konfirmasi') {
                            $rj_confirm_l += 1;
                        }
                    } 
                    // perempuan
                    else {
                        if ($kasus->status == 'suspek') {
                            $rj_suspect_p += 1;
                        } else if ($kasus->status == 'konfirmasi') {
                            $rj_confirm_p += 1;
                        }
                    }
                    break;
                case 'Rawat Inap':
                    // laki-laki
                    if ($kasus->kasus->pasien->gender == 1) {
                        if ($kasus->status == 'suspek') {
                            $ri_suspect_l += 1;
                        } else if ($kasus->status == 'konfirmasi') {
                            $ri_confirm_l += 1;
                        }
                    } 
                    // perempuan
                    else {
                        if ($kasus->status == 'suspek') {
                            $ri_suspect_p += 1;
                        } else if ($kasus->status == 'konfirmasi') {
                            $ri_confirm_p += 1;
                        }
                    }
                    break;
            }
        }

        $data = [
            'tanggal' => date('Y-m-d'),
            'igd_suspect_l' => $igd_suspect_l,
            'igd_suspect_p' => $igd_suspect_p,
            'igd_confirm_l' => $igd_confirm_l,
            'igd_confirm_p' => $igd_confirm_p,
            'rj_suspect_l' => $rj_suspect_l,
            'rj_suspect_p' => $rj_suspect_p,
            'rj_confirm_l' => $rj_confirm_l,
            'rj_confirm_p' => $rj_confirm_p,
            'ri_suspect_l' => $ri_suspect_l,
            'ri_suspect_p' => $ri_suspect_p,
            'ri_confirm_l' => $ri_confirm_l,
            'ri_confirm_p' => $ri_confirm_p,
        ];

        $this->sendDataPasien($data);

        echo "\n End process \n";
    }

    private function sendDataPasien($data)
    {
        echo "Send data Pasien \n";

        $headers['X-rs-id'] = config('app.sirs_id');
        $headers['X-pass'] = config('app.sirs_pass');
        $headers['X-Timestamp'] = Carbon::now()->timestamp;
        $headers['Accept'] ='application/x-www-form-urlencoded';
        $url = config('app.sirs_url').'/fo/index.php/LapV2/PasienMasuk';

        try
        {
            $client = new Client();
            $res = $client->request('POST', $url, [
                'headers' => $headers,
                'json' => $data
            ]);

            $content = json_decode($res->getBody()->getContents());
            echo $content->RekapPasienMasuk->message;
        } catch (RequestException $e) {
            $response = Psr7\str($e->getResponse());
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return 0;
        }
        catch (\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return 0;
        }
    }

}

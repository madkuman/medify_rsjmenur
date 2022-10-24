<?php

namespace App\Console\Commands\ThirdParty\SIRS;

use Illuminate\Console\Command;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class RekapPasienMasukCovid19Get extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'third-party-sirs:rekap-pasien-masuk-covid-19-get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data rekap pasien masuk covid19';

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

        $headers['X-rs-id'] = config('app.sirs_id');
        $headers['X-pass'] = config('app.sirs_pass');
        $headers['X-Timestamp'] = Carbon::now()->timestamp;
        $headers['Accept'] ='application/x-www-form-urlencoded';
        $url = config('app.sirs_url').'/fo/index.php/LapV2/PasienMasuk';

        try
        {
            $client = new Client();
            $res = $client->request('GET', $url, [
                'headers' => $headers,
            ]);

            echo "\n### Informasi data rekap pasien masuk covid19 ###\n\n";

            $content = json_decode($res->getBody()->getContents());
            $result = '';
            foreach ($content->RekapPasienMasuk as $key => $pasien_masuk) {
                $result .= "#######################################\n";
                $result .= "Id: $pasien_masuk->id\n";
                $result .= "Koders: $pasien_masuk->koders\n";
                $result .= "\n";
                $result .= "IGD Suspek Laki-laki: $pasien_masuk->igd_suspect_l\n";
                $result .= "IGD Suspek Perempuan: $pasien_masuk->igd_suspect_p\n";
                $result .= "IGD Konfirmasi Laki-laki: $pasien_masuk->igd_confirm_l\n";
                $result .= "IGD Konfirmasi Perempuan: $pasien_masuk->igd_confirm_p\n";
                $result .= "\n";
                $result .= "Rawat Jalan Suspek Laki-laki: $pasien_masuk->rj_suspect_l\n";
                $result .= "Rawat Jalan Suspek Perempuan: $pasien_masuk->rj_suspect_p\n";
                $result .= "Rawat Jalan Konfirmasi Laki-laki: $pasien_masuk->rj_confirm_l\n";
                $result .= "Rawat Jalan Konfirmasi Perempuan: $pasien_masuk->rj_confirm_p\n";
                $result .= "\n";
                $result .= "Rawat Inap Suspek Laki-laki: $pasien_masuk->ri_suspect_l\n";
                $result .= "Rawat Inap Suspek Perempuan: $pasien_masuk->ri_suspect_p\n";
                $result .= "Rawat Inap Konfirmasi Laki-laki: $pasien_masuk->ri_confirm_l\n";
                $result .= "Rawat Inap Konfirmasi Perempuan: $pasien_masuk->ri_confirm_p\n";
                $result .= "\n";
                $result .= "Tanggal Lapor: $pasien_masuk->tgl_lapor\n\n";
            }

            echo $result;
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
    }
}

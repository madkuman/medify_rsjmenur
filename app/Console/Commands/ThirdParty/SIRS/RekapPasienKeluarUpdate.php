<?php

namespace App\Console\Commands\Thirdparty\SIRS;

use App\Models\Kasus\Kasus;
use GuzzleHttp\Psr7;
use Illuminate\Console\Command;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class RekapPasienKeluarUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'third-party-sirs:rekap-pasien-keluar-harian-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update jumlah pasien Covid-19 yang keluar dari rumah sakit per hari berdasarkan status keluarnya';

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

        $kasus = Kasus::with('covid_status', 'pasien', 'diagnosis', 'alasan_krs', 'status_krs')
                        ->has('covid_status')
                        ->whereNotNull('krs_at')
                        ->where('krs_at', '>', now()->startOfDay())
                        ->get(); // kasus covid yg krs hari ini

        $data = $this->formData();

        echo "\nUpdate jumlah pasien Covid-19 yang keluar dari rumah sakit per hari berdasarkan status keluarnya\n";
        echo "Start\n";
        echo "Collecting data.....\n";

        foreach ($kasus as $k) {
            $covid_status = $k->covid_status->status;
            $alasan_krs = $k->alasan_krs->slug;
            $status_krs = $k->status_krs->slug;
            $lahir = $k->pasien->date_of_birth;
            $usia_hari = Carbon::parse($lahir)->diffInDays(now()); // usia dalam hari
            $usia_tahun = Carbon::parse($lahir)->diffInYears(now()); // usia dalam tahun
            $is_komorbid = $k->diagnosis->count() > 1;
            
            if ($status_krs == 'sembuh') {
                $data['sembuh'] ++;
            } else if ($status_krs == 'meninggal') {
                if ($is_komorbid) {
                    $data['meninggal_komorbid'] ++;
                    if ($usia_hari <= 6) {
                        $data['meninggal_prob_pre_komorbid'] ++;
                    } else if ($usia_hari >= 7 && $usia_hari <= 28) {
                        $data['meninggal_prob_neo_komorbid'] ++;
                    } else if ($usia_hari >= 29 && $usia_tahun < 1) {
                        $data['meninggal_prob_bayi_komorbid'] ++;
                    } else if ($usia_tahun >= 1 && $usia_tahun <= 4) {
                        $data['meninggal_prob_balita_komorbid'] ++;
                    } else if ($usia_tahun >= 5 && $usia_tahun <= 18) {
                        $data['meninggal_prob_anak_komorbid'] ++;
                    } else if ($usia_tahun >= 19 && $usia_tahun <= 40) {
                        $data['meninggal_prob_remaja_komorbid'] ++;
                    } else if ($usia_tahun >= 41 && $usia_tahun <= 60) {
                        $data['meninggal_prob_dws_komorbid'] ++;
                    } else if ($usia_tahun > 60) {
                        $data['meninggal_prob_lansia_komorbid'] ++;
                    }
                    if ($covid_status == 'discarded') {
                        $data['meninggal_discarded_komorbid'] ++;
                    }
                } else {
                    $data['meninggal_tanpa_komorbid'] ++;
                    if ($usia_hari <= 6) {
                        $data['meninggal_prob_pre_tanpa_komorbid'] ++;
                    } else if ($usia_hari >= 7 && $usia_hari <= 28) {
                        $data['meninggal_prob_neo_tanpa_komorbid'] ++;
                    } else if ($usia_hari >= 29 && $usia_tahun < 1) {
                        $data['meninggal_prob_bayi_tanpa_komorbid'] ++;
                    } else if ($usia_tahun >= 1 && $usia_tahun <= 4) {
                        $data['meninggal_prob_balita_tanpa_komorbid'] ++;
                    } else if ($usia_tahun >= 5 && $usia_tahun <= 18) {
                        $data['meninggal_prob_anak_tanpa_komorbid'] ++;
                    } else if ($usia_tahun >= 19 && $usia_tahun <= 40) {
                        $data['meninggal_prob_remaja_tanpa_komorbid'] ++;
                    } else if ($usia_tahun >= 41 && $usia_tahun <= 60) {
                        $data['meninggal_prob_dws_tanpa_komorbid'] ++;
                    } else if ($usia_tahun > 60) {
                        $data['meninggal_prob_lansia_tanpa_komorbid'] ++;
                    }
                    if ($covid_status == 'discarded') {
                        $data['meninggal_discarded_komorbid'] ++;
                    }
                }
            }

            if ($status_krs != 'meninggal') {
                if ($covid_status == 'discarded') {
                    $data['discarded'] ++;
                }
                if ($alasan_krs == 'rujuk') {
                    $data['dirujuk'] ++;
                } else if ($alasan_krs == 'aps') {
                    $data['aps'] ++;
                }
            }
        }

        $result = $this->updateData($data);
        echo "Updating data.....\n";
        echo $result->message;
        echo "\nDone\n";
    }

    private function updateData($data) {
        $headers['X-rs-id'] = config('app.sirs_id');
        $headers['X-Timestamp'] = now()->timestamp;
        $headers['X-pass'] = config('app.sirs_pass');
        $headers['Accept'] ='application/x-www-form-urlencoded';
        $url = config('app.sirs_url').'/fo/index.php/LapV2/PasienKeluar';

        try {
            $client = new Client();
            $res = $client->request('POST', $url, 
                [
                    'headers' => $headers,
                    'json' => $data
                ]
            );
    
            $content = json_decode($res->getBody()->getContents());
            $data = $content->RekapPasienKeluar[0];
            
            return $data;
        } catch (RequestException $e) {
            $response = Psr7\str($e->getResponse());
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return 0;
        }

    }

    private function formData() {
        $data['tanggal'] = now()->format('Y-m-d');
        $data['sembuh'] = 0;
        $data['discarded'] = 0;
        $data['meninggal_komorbid'] = 0;
        $data['meninggal_tanpa_komorbid'] = 0;
        $data['meninggal_prob_pre_komorbid'] = 0;
        $data['meninggal_prob_neo_komorbid'] = 0;
        $data['meninggal_prob_bayi_komorbid'] = 0;
        $data['meninggal_prob_balita_komorbid'] = 0;
        $data['meninggal_prob_anak_komorbid'] = 0;
        $data['meninggal_prob_remaja_komorbid'] = 0;
        $data['meninggal_prob_dws_komorbid'] = 0;
        $data['meninggal_prob_lansia_komorbid'] = 0;
        $data['meninggal_prob_pre_tanpa_komorbid'] = 0;
        $data['meninggal_prob_neo_tanpa_komorbid'] = 0;
        $data['meninggal_prob_bayi_tanpa_komorbid'] = 0;
        $data['meninggal_prob_balita_tanpa_komorbid'] = 0;
        $data['meninggal_prob_anak_tanpa_komorbid'] = 0;
        $data['meninggal_prob_remaja_tanpa_komorbid'] = 0;
        $data['meninggal_prob_dws_tanpa_komorbid'] = 0;
        $data['meninggal_prob_lansia_tanpa_komorbid'] = 0;
        $data['meninggal_discarded_komorbid'] = 0;
        $data['meninggal_discarded_tanpa_komorbid'] = 0;
        $data['dirujuk'] = 0;
        $data['isman'] = 0;
        $data['aps'] = 0;

        return $data;
    }
}

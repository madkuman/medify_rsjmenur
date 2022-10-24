<?php

namespace App\Console\Commands\ThirdParty\SIRS;

use App\Models\Kasus\Kasus;
use App\Models\RawatInap\Transaksi;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use GuzzleHttp\Psr7;

class RekapPasienDirawatDenganKomorbidUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'third-party-sirs:rekap-pasien-dirawat-dengan-komorbid-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update jumlah pasien Covid-19 yang masih dirawat inap (dengan komorbid) di rumah sakit per hari';

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
        if (empty(config('app.sirs_id')) || empty(config('app.sirs_pass'))) {
            return 0;
        }

        $rawat_inap = Transaksi::whereStatus(1)->where('kedatangan_at', '>', now()->startOfDay())->pluck('kasus_id'); //ranap yg masih di rs
        $kasus = Kasus::with('covid_status', 'pasien', 'diagnosis', 'rawat_inap_transaksi_last.tempat_tidur.ruangan')->has('covid_status')->find($rawat_inap); //kasus covid

        $data = $this->formData();

        echo "\nUpdate jumlah pasien Covid-19 yang masih dirawat inap (dengan komorbid) di rumah sakit per hari\n";
        echo "Start\n";
        echo "Collecting data.....\n";

        foreach ($kasus as $k) {
            $is_komorbid = $k->diagnosis->count() > 1;
            if ($is_komorbid) {
                $tempat_tidur = $k->rawat_inap_transaksi_last->tempat_tidur->ruangan->sirs_covid_19_tt_id;
                $gender = $k->pasien->gender;
                $covid_status = $k->covid_status->status;

                if ($tempat_tidur == 26) { // icu dengan ventilator
                    if ($covid_status == 'konfirmasi') {
                        if ($gender == 1) {
                            $data['icu_dengan_ventilator_confirm_l'] ++;
                        } else if ($gender == 2) {
                            $data['icu_dengan_ventilator_confirm_p'] ++;
                        }
                    } else if ($covid_status == 'positif') {
                        if ($gender == 1) {
                            $data['icu_dengan_ventilator_suspect_l'] ++;
                        } else if ($gender == 2) {
                            $data['icu_dengan_ventilator_suspect_p'] ++;
                        }
                    }
                } else if ($tempat_tidur == 27) { // icu tanpa ventilator
                    if ($covid_status == 'konfirmasi') {
                        if ($gender == 1) {
                            $data['icu_tanpa_ventilator_confirm_l'] ++;
                        } else if ($gender == 2) {
                            $data['icu_tanpa_ventilator_confirm_p'] ++;
                        }
                    } else if ($covid_status == 'suspek') {
                        if ($gender == 1) {
                            $data['icu_tanpa_ventilator_suspect_l'] ++;
                        } else if ($gender == 2) {
                            $data['icu_tanpa_ventilator_suspect_p'] ++;
                        }
                    }
                } else if ($tempat_tidur == 24) { // icu tekanan negatif dengan ventilator
                    if ($covid_status == 'konfirmasi') {
                        if ($gender == 1) {
                            $data['icu_tekanan_negatif_dengan_ventilator_confim_l'] ++;
                        } else if ($gender == 2) {
                            $data['icu_tekanan_negatif_dengan_ventilator_confim_p'] ++;
                        }
                    } else if ($covid_status == 'suspek') {
                        if ($gender == 1) {
                            $data['icu_tekanan_negatif_dengan_ventilator_suspect_l'] ++;
                        } else if ($gender == 2) {
                            $data['icu_tekanan_negatif_dengan_ventilator_suspect_p'] ++;
                        }
                    }
                } else if ($tempat_tidur == 25) { // icu tekanan negatif tanpa ventilator
                    if ($covid_status == 'konfirmasi') {
                        if ($gender == 1) {
                            $data['icu_tekanan_negatif_tanpa_ventilator_confim_l'] ++;
                        } else if ($gender == 2) {
                            $data['icu_tekanan_negatif_tanpa_ventilator_confim_p'] ++;
                        }
                    } else if ($covid_status == 'suspek') {
                        if ($gender == 1) {
                            $data['icu_tekanan_negatif_tanpa_ventilator_suspect_l'] ++;
                        } else if ($gender == 2) {
                            $data['icu_tekanan_negatif_tanpa_ventilator_suspect_p'] ++;
                        }
                    }
                } else if ($tempat_tidur == 28) { // isolasi tekanan negatif
                    if ($covid_status == 'konfirmasi') {
                        if ($gender == 1) {
                            $data['isolasi_tekanan_negatif_confirm_l'] ++;
                        } else if ($gender == 2) {
                            $data['isolasi_tekanan_negatif_confirm_p'] ++;
                        }
                    } else if ($covid_status == 'suspek') {
                        if ($gender == 1) {
                            $data['isolasi_tekanan_negatif_suspect_l'] ++;
                        } else if ($gender == 2) {
                            $data['isolasi_tekanan_negatif_suspect_p'] ++;
                        }
                    }
                } else if ($tempat_tidur == 29) { // isolasi tanpa tekanan negatif
                    if ($covid_status == 'konfirmasi') {
                        if ($gender == 1) {
                            $data['isolasi_tanpa_tekanan_negatif_confirm_l'] ++;
                        } else if ($gender == 2) {
                            $data['isolasi_tanpa_tekanan_negatif_confirm_p'] ++;
                        }
                    } else if ($covid_status == 'suspek') {
                        if ($gender == 1) {
                            $data['isolasi_tanpa_tekanan_negatif_suspect_l'] ++;
                        } else if ($gender == 2) {
                            $data['isolasi_tanpa_tekanan_negatif_suspect_p'] ++;
                        }
                    }
                } else if ($tempat_tidur == 30) { // NICU
                    if ($covid_status == 'konfirmasi') {
                        if ($gender == 1) {
                            $data['nicu_khusus_covid_confirm_l'] ++;
                        } else if ($gender == 2) {
                            $data['nicu_khusus_covid_confirm_p'] ++;
                        }
                    } else if ($covid_status == 'suspek') {
                        if ($gender == 1) {
                            $data['nicu_khusus_covid_suspect_l'] ++;
                        } else if ($gender == 2) {
                            $data['nicu_khusus_covid_suspect_p'] ++;
                        }
                    }
                } else if ($tempat_tidur == 31) { // PICU
                    if ($covid_status == 'konfirmasi') {
                        if ($gender == 1) {
                            $data['picu_khusus_covid_confirm_l'] ++;
                        } else if ($gender == 2) {
                            $data['picu_khusus_covid_confirm_p'] ++;
                        }
                    } else if ($covid_status == 'suspek') {
                        if ($gender == 1) {
                            $data['picu_khusus_covid_suspect_l'] ++;
                        } else if ($gender == 2) {
                            $data['picu_khusus_covid_suspect_p'] ++;
                        }
                    }
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
        $headers['Accept'] = 'application/x-www-form-urlencoded';
        $url = config('app.sirs_url') . '/fo/index.php/LapV2/PasienDirawatKomorbid';

        try {
            $client = new Client();
            $res = $client->request('POST', $url,
                [
                    'headers' => $headers,
                    'json' => $data
                ]
            );

            $content = json_decode($res->getBody()->getContents());
            $data = $content->RekapPasienDirawatKomorbid[0];

            return $data;
        } catch (RequestException $e) {
            $response = Psr7\str($e->getResponse());
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return 0;
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return 0;
        }
    }

    private function formData() {
        $data['tanggal'] = now()->format('Y-m-d');
        $data['icu_dengan_ventilator_suspect_l'] = 0;
        $data['icu_dengan_ventilator_suspect_p'] = 0;
        $data['icu_dengan_ventilator_confirm_l'] = 0;
        $data['icu_dengan_ventilator_confirm_p'] = 0;
        $data['icu_tanpa_ventilator_suspect_l'] = 0;
        $data['icu_tanpa_ventilator_suspect_p'] = 0;
        $data['icu_tanpa_ventilator_confirm_l'] = 0;
        $data['icu_tanpa_ventilator_confirm_p'] = 0;
        $data['icu_tekanan_negatif_dengan_ventilator_suspect_l'] = 0;
        $data['icu_tekanan_negatif_dengan_ventilator_suspect_p'] = 0;
        $data['icu_tekanan_negatif_dengan_ventilator_confirm_l'] = 0;
        $data['icu_tekanan_negatif_dengan_ventilator_confirm_p'] = 0;
        $data['icu_tekanan_negatif_tanpa_ventilator_suspect_l'] = 0;
        $data['icu_tekanan_negatif_tanpa_ventilator_suspect_p'] = 0;
        $data['icu_tekanan_negatif_tanpa_ventilator_confirm_l'] = 0;
        $data['icu_tekanan_negatif_tanpa_ventilator_confirm_p'] = 0;
        $data['isolasi_tekanan_negatif_suspect_l'] = 0;
        $data['isolasi_tekanan_negatif_suspect_p'] = 0;
        $data['isolasi_tekanan_negatif_confirm_l'] = 0;
        $data['isolasi_tekanan_negatif_confirm_p'] = 0;
        $data['isolasi_tanpa_tekanan_negatif_suspect_l'] = 0;
        $data['isolasi_tanpa_tekanan_negatif_suspect_p'] = 0;
        $data['isolasi_tanpa_tekanan_negatif_confirm_l'] = 0;
        $data['isolasi_tanpa_tekanan_negatif_confirm_p'] = 0;
        $data['nicu_khusus_covid_suspect_l'] = 0;
        $data['nicu_khusus_covid_suspect_p'] = 0;
        $data['nicu_khusus_covid_confirm_l'] = 0;
        $data['nicu_khusus_covid_confirm_p'] = 0;
        $data['picu_khusus_covid_suspect_l'] = 0;
        $data['picu_khusus_covid_suspect_p'] = 0;
        $data['picu_khusus_covid_confirm_l'] = 0;
        $data['picu_khusus_covid_confirm_p'] = 0;

        return $data;
    }
}

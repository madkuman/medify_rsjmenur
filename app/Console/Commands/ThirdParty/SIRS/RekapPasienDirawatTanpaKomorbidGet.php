<?php

namespace App\Console\Commands\ThirdParty\SIRS;

use App\Models\Kasus\Kasus;
use App\Models\RawatInap\Transaksi;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class RekapPasienDirawatTanpaKomorbidGet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'third-party-sirs:rekap-pasien-dirawat-tanpa-komorbid {tanggal=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Informasi jumlah pasien Covid-19 yang masih dirawat inap (tanpa komorbid) di rumah sakit per hari, format: YYYY-MM-DD';

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

        $headers['X-rs-id'] = config('app.sirs_id');
        $headers['X-Timestamp'] = now()->timestamp;
        $headers['X-pass'] = config('app.sirs_pass');
        $headers['Accept'] = 'application/json';
        $url = config('app.sirs_url') . '/fo/index.php/LapV2/PasienDirawatTanpaKomorbid';

        $client = new Client();
        $res = $client->request('GET', $url,
            [
                'headers' => $headers
            ]
        );
        $content = json_decode($res->getBody()->getContents());
        $data = $content->RekapPasienDirawatTanpaKomorbid;

        $arguments = $this->arguments();
        $tanggal = $arguments['tanggal'];
        
        if ($tanggal == 0) {
            $tanggal = now()->format('Y-m-d');
        }

        echo "\nInformasi jumlah pasien Covid-19 yang masih dirawat inap (dengan komorbid) di rumah sakit per tanggal $tanggal\n";
        $result = "\nData tidak ada.";
        foreach ($data as $d) {
            if ($d->tanggal == $tanggal) {
                echo "#########################################\n";
                echo "id :".$d->id."\n";
                echo "koders :".$d->koders."\n";
                echo "tanggal :".$d->tanggal."\n";
                echo "icu_dengan_ventilator_suspect_l :".$d->icu_dengan_ventilator_suspect_l."\n";
                echo "icu_dengan_ventilator_suspect_p :".$d->icu_dengan_ventilator_suspect_p."\n";
                echo "icu_dengan_ventilator_confirm_l :".$d->icu_dengan_ventilator_confirm_l."\n";
                echo "icu_dengan_ventilator_confirm_p :".$d->icu_dengan_ventilator_confirm_p."\n";
                echo "icu_tanpa_ventilator_suspect_l :".$d->icu_tanpa_ventilator_suspect_l."\n";
                echo "icu_tanpa_ventilator_suspect_p :".$d->icu_tanpa_ventilator_suspect_p."\n";
                echo "icu_tanpa_ventilator_confirm_l :".$d->icu_tanpa_ventilator_confirm_l."\n";
                echo "icu_tanpa_ventilator_confirm_p :".$d->icu_tanpa_ventilator_confirm_p."\n";
                echo "icu_tekanan_negatif_dengan_ventilator_suspect_l :".$d->icu_tekanan_negatif_dengan_ventilator_suspect_l."\n";
                echo "icu_tekanan_negatif_dengan_ventilator_suspect_p :".$d->icu_tekanan_negatif_dengan_ventilator_suspect_p."\n";
                echo "icu_tekanan_negatif_dengan_ventilator_confirm_l :".$d->icu_tekanan_negatif_dengan_ventilator_confim_l."\n";
                echo "icu_tekanan_negatif_dengan_ventilator_confirm_p :".$d->icu_tekanan_negatif_dengan_ventilator_confim_p."\n";
                echo "icu_tekanan_negatif_tanpa_ventilator_suspect_l :".$d->icu_tekanan_negatif_tanpa_ventilator_suspect_l."\n";
                echo "icu_tekanan_negatif_tanpa_ventilator_suspect_p :".$d->icu_tekanan_negatif_tanpa_ventilator_suspect_p."\n";
                echo "icu_tekanan_negatif_tanpa_ventilator_confirm_l :".$d->icu_tekanan_negatif_tanpa_ventilator_confim_l."\n";
                echo "icu_tekanan_negatif_tanpa_ventilator_confirm_p :".$d->icu_tekanan_negatif_tanpa_ventilator_confim_p."\n";
                echo "isolasi_tekanan_negatif_suspect_l :".$d->isolasi_tekanan_negatif_suspect_l."\n";
                echo "isolasi_tekanan_negatif_suspect_p :".$d->isolasi_tekanan_negatif_suspect_p."\n";
                echo "isolasi_tekanan_negatif_confirm_l :".$d->isolasi_tekanan_negatif_confirm_l."\n";
                echo "isolasi_tekanan_negatif_confirm_p :".$d->isolasi_tekanan_negatif_confirm_p."\n";
                echo "isolasi_tanpa_tekanan_negatif_suspect_l :".$d->isolasi_tanpa_tekanan_negatif_suspect_l."\n";
                echo "isolasi_tanpa_tekanan_negatif_suspect_p :".$d->isolasi_tanpa_tekanan_negatif_suspect_p."\n";
                echo "isolasi_tanpa_tekanan_negatif_confirm_l :".$d->isolasi_tanpa_tekanan_negatif_confirm_l."\n";
                echo "isolasi_tanpa_tekanan_negatif_confirm_p :".$d->isolasi_tanpa_tekanan_negatif_confirm_p."\n";
                echo "nicu_khusus_covid_suspect_l :".$d->nicu_khusus_covid_suspect_l."\n";
                echo "nicu_khusus_covid_suspect_p :".$d->nicu_khusus_covid_suspect_p."\n";
                echo "nicu_khusus_covid_confirm_l :".$d->nicu_khusus_covid_confirm_l."\n";
                echo "nicu_khusus_covid_confirm_p :".$d->nicu_khusus_covid_confirm_p."\n";
                echo "picu_khusus_covid_suspect_l :".$d->picu_khusus_covid_suspect_l."\n";
                echo "picu_khusus_covid_suspect_p :".$d->picu_khusus_covid_suspect_p."\n";
                echo "picu_khusus_covid_confirm_l :".$d->picu_khusus_covid_confirm_l."\n";
                echo "picu_khusus_covid_confirm_p :".$d->picu_khusus_covid_confirm_p."\n";
                echo "tgl_lapor :".$d->tgl_lapor."\n";
                echo "#########################################\n";
                $result = "Done.";
            }
        }

        echo $result;
    }
}

<?php

namespace App\Console\Commands\thirdparty\sirs;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class RekapPasienKeluarGet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'third-party-sirs:rekap-pasien-keluar-harian {tanggal=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Informasi jumlah pasien Covid-19 yang keluar dari rumah sakit per hari berdasarkan status keluarnya, format: YYYY-MM-DD';

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
        $url = config('app.sirs_url') . '/fo/index.php/LapV2/PasienKeluar';

        $client = new Client();
        $res = $client->request('GET', $url,
            [
                'headers' => $headers
            ]
        );
        $content = json_decode($res->getBody()->getContents());
        $data = $content->RekapPasienKeluar;

        $arguments = $this->arguments();
        $tanggal = $arguments['tanggal'];
        
        if ($tanggal == 0) {
            $tanggal = now()->format('Y-m-d');
        }

        echo "\nInformasi jumlah pasien Covid-19 yang keluar dari rumah sakit per tanggal $tanggal berdasarkan status keluarnya\n";
        $result = "Data tidak ada.";
        
        foreach ($data as $d) {
            if ($d->tanggal == $tanggal) {
                echo "#########################################\n";
                echo "id :".$d->id."\n";
                echo "koders :".$d->koders."\n";
                echo "tanggal :".$d->tanggal."\n";
                echo "sembuh :".$d->sembuh."\n";
                echo "discarded :".$d->discarded."\n";
                echo "meninggal_komorbid :".$d->meninggal_komorbid."\n";
                echo "meninggal_tanpa_komorbid :".$d->meninggal_tanpa_komorbid."\n";
                echo "meninggal_prob_pre_komorbid :".$d->meninggal_prob_pre_komorbid."\n";
                echo "meninggal_prob_neo_komorbid :".$d->meninggal_prob_neo_komorbid."\n";
                echo "meninggal_prob_bayi_komorbid :".$d->meninggal_prob_bayi_komorbid."\n";
                echo "meninggal_prob_balita_komorbid :".$d->meninggal_prob_balita_komorbid."\n";
                echo "meninggal_prob_anak_komorbid :".$d->meninggal_prob_anak_komorbid."\n";
                echo "meninggal_prob_remaja_komorbid :".$d->meninggal_prob_remaja_komorbid."\n";
                echo "meninggal_prob_dewasa_komorbid :".$d->meninggal_prob_dws_komorbid."\n";
                echo "meninggal_prob_lansia_komorbid :".$d->meninggal_prob_lansia_komorbid."\n";
                echo "meninggal_prob_pre_tanpa_komorbid :".$d->meninggal_prob_pre_tanpa_komorbid."\n";
                echo "meninggal_prob_neo_tanpa_komorbid :".$d->meninggal_prob_neo_tanpa_komorbid."\n";
                echo "meninggal_prob_bayi_tanpa_komorbid :".$d->meninggal_prob_bayi_tanpa_komorbid."\n";
                echo "meninggal_prob_balita_tanpa_komorbid :".$d->meninggal_prob_balita_tanpa_komorbid."\n";
                echo "meninggal_prob_anak_tanpa_komorbid :".$d->meninggal_prob_anak_tanpa_komorbid."\n";
                echo "meninggal_prob_remaja_tanpa_komorbid :".$d->meninggal_prob_remaja_tanpa_komorbid."\n";
                echo "meninggal_prob_dewasa_tanpa_komorbid :".$d->meninggal_prob_dws_tanpa_komorbid."\n";
                echo "meninggal_prob_lansia_tanpa_komorbid :".$d->meninggal_prob_lansia_tanpa_komorbid."\n";
                echo "meninggal_discarded_komorbid :".$d->meninggal_discarded_komorbid."\n";
                echo "meninggal_discarded_tanpa_komorbid :".$d->meninggal_discarded_tanpa_komorbid."\n";
                echo "dirujuk :".$d->dirujuk."\n";
                echo "isman :".$d->isman."\n";
                echo "aps :".$d->aps."\n";
                echo "tgl_lapor :".$d->tgl_lapor."\n";
                echo "#########################################\n";
                $result = "Done";
            }
        }

        echo $result;
    }
}

<?php

namespace App\Console\Commands\DataGenerator;

use Illuminate\Console\Command;
use Faker\Factory as Faker;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Hospital\Kelas;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\AntrianLevel;
use App\Models\RawatJalan\Transaksi as TransaksiRJ;
use App\Models\IGD\Transaksi as TransaksiIGD;
use App\Models\IGD\Ruangan as IGDRuangan;
use App\Models\RawatInap\TempatTidur;
use App\Models\RawatInap\Transaksi as TransaksiRI;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\ICD10;
use App\Models\Kasus\Tindakan;
use App\Models\Kasus\ICD9;
use Carbon\Carbon;
use Artisan;

class KasusSimulator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "data-generator:kasus-simulator {total-px=1} {date_start=0} {date_end=0}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $layanan_rj = 1;
    protected $layanan_igd= 2;
    protected $last_pasien_id = 0;

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
        $this->last_pasien_id = Pasien::orderBy('id','desc')->first()->id ?? null;
        $arguments = $this->arguments();
        $date_start = $arguments['date_start'];
        $date_end = $arguments['date_end'];
        $total_px = $arguments['total-px'];

        if($date_start != 0) $start = Carbon::createFromFormat('d-m-Y',$date_start)->startOfDay();
        else $start = Carbon::now();

        if($date_end != 0) $end= Carbon::createFromFormat('d-m-Y',$date_end)->endOfDay();
        else $end = Carbon::now()->endOfDay();

        $faker = Faker::create('id_ID');

        $today = Carbon::today()->startOfDay();
        $start_date = $start;
        $current_date = $start->copy()->addHours(1);

        while($current_date <= $end){
            echo "\n\n ---------------- Start :".$current_date->format('d-m-Y')."-----------------\n";
            $new_kasus_ids_ri = [];
            $kasus_id_krs = [];
            Carbon::setTestNow($current_date);
            $pasien_ids = Pasien::whereNull('death_at')->get()->random($total_px)->pluck('id')->toArray();

            $data['date'] = $current_date;

            foreach($pasien_ids as $index=> $pasien_id){
                $data = [];
                $data['pasien_id'] = $pasien_id;
                $data['date'] = $current_date;

                $pasien_pembayaran = PasienPembayaran::where('pasien_id',$pasien_id)->where('utama',1)->first();

                $data['pasien_pembayaran_id'] = $pasien_pembayaran->id;
                if($pasien_pembayaran->perusahaan->tipe->slug == 'bpjs') $data['is_bpjs'] = 1;
                else $data['is_bpjs'] = 0;

                $data = $this->pendaftaranPasien($data);
                $data = $this->layaniPasien($data);

                foreach($data['kasus_id'] as $kasus_id){
                    //echo "KASUS ID : ".$kasus_id."\n";

                    $this->generateDataKasus($kasus_id);

                    $random = $faker->numberBetween(1,5);
                    if($random > 1) {
                        $kasus_id_krs[] = $kasus_id;
                        echo $index." DONE PENDAFTARAN: ".$pasien_id."-".$kasus_id."-KRS\n";
                    }
                    else {
                        $new_kasus_ids_ri[] = $kasus_id;
                        echo $index." DONE PENDAFTARAN: ".$pasien_id."-".$kasus_id."-RANAP\n";
                    }
                }
            }

            $this->daftarRanap($new_kasus_ids_ri,$data);
            $kasus_id_krs_new = $this->simulateRanap($data);
            $kasus_id_krs_old = $this->getKasusBeKrs($data);
            $kasus_id_krs = array_merge($kasus_id_krs,$kasus_id_krs_new,$kasus_id_krs_old);
            $kasus_id_krs = array_unique($kasus_id_krs);


            $this->doKrs($kasus_id_krs); 

            echo "\nARTISAN DAILY RJ:IMPORT\n";
            Artisan::call('rawatjalan:importlaporan');
            echo "ARTISAN DAILY IGD:IMPORT\n";
            Artisan::call('igd:importlaporan');
            echo "ARTISAN DAILY RI:IMPORT\n";
            Artisan::call('rawatinap:importlaporan');
            /*
            echo "ARTISAN DAILY RI:ADMISI\n";
            Artisan::call('rawatinap:admisi');
            echo "ARTISAN STATISTIK HARIAN\n";
            Artisan::call('rawatinap:create-statistik-harian');

            $last_day_of_month = $current_date->copy()->endOfMonth()->endOfDay();
            $current_date_end = $current_date->copy()->endOfDay();
            if($current_date_end == $last_day_of_month)
            {
                echo "ARTISAN STATISTIK BULANAN\n";
                Artisan::call('rawatinap:create-statistik-main', ['type' => 'bulan','start_date' => $current_date_end->format('d-m-Y')]);
            }
            */

            $current_date->addDay();
        }

    }

    private function generateDataKasus($kasus_id){
        //echo 'GENERATE DATA KASUS '.$kasus_id."\n";
        $faker = Faker::create('id_ID');

        $kasus = Kasus::find($kasus_id);
        $icd_10 = [71,14009,4468,1078,2927,7845,19954,27815,18412,10304,10287,6155,3849,6309,6318,9384,3231,619,14706,18415];
        $icd_9 = [2, 383, 419, 426, 1024, 
            2048, 3328, 8448, 3584, 2816, 
            6481, 82, 338, 594, 2461,
            850, 1106, 1362, 1618, 926];


            $random = $faker->numberBetween(0,19);
            $desc = ICD9::find($icd_9[$random])->long_desc;

            $dx = new \Illuminate\Http\Request();
            $dx->replace([
                'nomor-kasus' => $kasus->nomor_kasus,
                'id-diagnosis' => $icd_10[$random],
                'type' => 'utama',
            ]);

            app('App\Http\Controllers\Kasus\Diagnosis\CreateController')->createNewDiagnosis($dx);

            $icd9 = new \Illuminate\Http\Request();
            $icd9->replace([
                'kategori-tindakan' => 'icd9',
                'icd_9' => $icd_9[$random],
                'desc_icd' => $desc
            ]);

            app('App\Http\Controllers\Kasus\Tindakan\CreateController')->createNewTindakan($icd9,$kasus->nomor_kasus);
        }

        private function simulateRanap($data)
        {
            $today_end = $data['date']->endOfDay();
            $faker = Faker::create('id_ID');
            $kasus_ri_ids = Kasus::where('tipe_ri',1)->whereDate('mrs_at','<',$today_end)->whereNull('krs_at')->pluck('id')->toArray();
            echo "\n\n----SIMULASI RANAP : ".$today_end->format('d-m-Y')."----".count($kasus_ri_ids)."----\n";
            $kasus_id_krs = [];

            foreach($kasus_ri_ids as $kasus)
            {
                $random = $faker->numberBetween(1,5); 


                if($random > 4) {
                    $kasus_id_krs[] = $kasus;
                    echo "KASUS RANAP: ".$kasus."-KRS\n";
                }
                else {
                    echo "KASUS RANAP: ".$kasus."-RANAP TERUS\n";
                }
            }

            return $kasus_id_krs;
        }

        private function daftarRanap($new_kasus_ids_ri,$data)
        {
            $kasus_permintaan_ranap = TransaksiRI::where('status',0)->whereNull('waktu_keluar')->where('is_pindah',0)->whereDate('waktu_masuk','<',$data['date'])->orderBy('kasus_id')->pluck('kasus_id')->toArray();
            $faker = Faker::create('id_ID');

            $kasus_id_list= array_merge($new_kasus_ids_ri,$kasus_permintaan_ranap);

            $today_end = Carbon::now()->endOfDay();
            echo "\n\n DAFTARRANAP : ".$today_end->format('d-m-Y')."----".count($kasus_id_list)."\n";


            $tempat_tidur = TempatTidur::whereNull('transaksi_id')->first();
            if(empty($tempat_tidur->id)) {
                echo "KAMAR FULL\n";
                return 1;
            }

            foreach($kasus_id_list as $kasus_id)
            {
                $pendaftaran_data = new \Illuminate\Http\Request();
                //echo 'Sedang Mendaftarkan Kasus ke Ranap : '.$kasus_id."\n";
                $kasus = Kasus::find($kasus_id);

                $checkPermintaanRanap = app('App\Http\Controllers\Kasus\Pengaturan\PostController')->checkIfPermintaanRanapExist($kasus->nomor_kasus);

                if($checkPermintaanRanap == 1){
                    if(empty($kasus->nomor_kasus)) dd($kasus_id);
                    $pendaftaran_data->replace([
                        'nomor_kasus' => $kasus->nomor_kasus
                    ]);

                    app('App\Http\Controllers\Kasus\Administrasi\PostController')->rawatInapDaftar($pendaftaran_data);
                }

                //echo 'Permintaan Ranap : '.$kasus_id."\n";
                $transaksi = TransaksiRI::where('status',0)->whereNull('waktu_keluar')->where('is_pindah',0)->where('kasus_id',$kasus_id)->first();

                if(empty($transaksi->tempat_tidur_id))
                {
                    $tempat_tidur = TempatTidur::whereNull('transaksi_id')->first();
                    if(empty($tempat_tidur->id)) { continue; }
                    $is_booking = 0;
                    $nomor_kasus = $kasus->nomor_kasus;

                    $pendaftaran_data->replace([
                        'transaksi_id' => $transaksi->id,
                        'nomor_kasus' => $nomor_kasus,
                        'bed_id' => $tempat_tidur->id,
                        'no_sep' => $this->generateNoSEP($kasus->created_at)
                    ]);


                    app('App\Http\Controllers\RawatInap\Transaksi\PostController')->pendaftaranSubmit($pendaftaran_data);

                    //echo 'Selesai Mendaftarkan Kasus ke Ranap : '.$kasus_id."\n";
                }

                //echo 'Akan Konfirmasi ke Ranap : '.$kasus_id."-".$transaksi->id."\n";
                app('App\Http\Controllers\RawatInap\Transaksi\PostController')->konfirmasiDatang($pendaftaran_data,$transaksi->id);

                echo 'Selesai Konfirmasi Kedatangan Kasus ke Ranap : '.$kasus_id."\n";
            }

        }

        private function pendaftaranPasien($data)
        {
            $faker = Faker::create('id_ID');

        //echo "\nPASIENID:".$data['pasien_id']."\n";
        //echo "Sedang Mendaftarkan \n";

            $random_layanan = $faker->numberBetween(1,6);
            if($random_layanan > 5) $layanan = $this->layanan_igd; 
            else $layanan = $this->layanan_rj; 
            $igd_ruangan_id = null;
            $poliklinik_id = null;

            if($layanan == $this->layanan_igd) $igd_ruangan_id=IGDRuangan::all()->random(1)->first()->id;
            else $poliklinik_id = Poliklinik::all()->random(1)->first()->id;

            $random = $faker->numberBetween(1,21);
            if($random > 20) $antrian_kelas = 1;
            else $antrian_kelas = 2; 

            $kelas = 3;

            $pendaftaran_data = new \Illuminate\Http\Request();
            $pendaftaran_data->replace([
                'layanan' => $layanan,
                'no_sep' => $this->generateNoSEP($data['date']),
                'pasien_id' => $data['pasien_id'],
                'bayar_id' => $data['pasien_pembayaran_id'],
                'ruangan_id' => $igd_ruangan_id,
                'poliklinik_id' => $poliklinik_id,
                'kelas' => $kelas,
                'rujuk_id' => 0,
                'kasus_id' => null,
                'asal_rujukan' => null,
                'paket_urikkes' => null,
                'confirmed' => null,
                'tanggal_pemesanan' => null,
                'is_bpjs' => $data['is_bpjs'],
                'antrian_kelas' => $antrian_kelas,
            ]);

            app('App\Http\Controllers\Pasien\Pasien\PostController')->APIPendaftaranPasien($pendaftaran_data);

        //echo 'Done Pendaftaran PASIENID: '.$data['pasien_id']."\n";

            $data['layanan'] = $layanan;

            return $data;
        }

        private function layaniPasien($data){
            $kasus_id = [];
            $today_start = Carbon::now()->startOfDay();
            $today_end = Carbon::now()->endOfDay();

            $waktu_layani =  $today_start->copy()->addHours(8);

            if($data['layanan'] == $this->layanan_rj){

                $transaksi = TransaksiRJ::where('pasien_id', $data['pasien_id'])->whereBetween('ordered_at',[$today_start,$today_end])->whereNull('kasus_id')->get();

                foreach($transaksi as $item_transaksi)
                {
                //echo 'Sedang Melayani RJ_ID: '.$item_transaksi->id."\n";
                    $layani_rj_data = new \Illuminate\Http\Request();
                    $layani_rj_data->replace([
                        'transaksi_id' => $item_transaksi->id,
                    ]);

                    app('App\Http\Controllers\RawatJalan\Transaksi\PostController')->layaniPasien($layani_rj_data);
                }

                $kasus_id = TransaksiRJ::where('pasien_id', $data['pasien_id'])->whereBetween('ordered_at',[$today_start,$today_end])->whereHas('kasus', function($q){
                    $q->from(app('config.db_name').'_kasus.kasus')->whereNull('krs_at');
                })->pluck('kasus_id')->toArray();
            }
            else
            {
                /*$transaksi = TransaksiIGD::where('pasien_id', $data['pasien_id'])->whereBetween('waktu_masuk',[$today_start,$today_end])->whereNull('waktu_keluar')->get();

                foreach($transaksi as $item_transaksi)
                {
                    echo 'Sedang Melayani IGD_ID: '.$item_transaksi->id."\n";
                    //app('App\Http\Controllers\IGD\Transaksi\PostController')->updatePengisian($item_transaksi->id,null);
                }*/

                $kasus_id = TransaksiIGD::where('pasien_id', $data['pasien_id'])->whereBetween('waktu_masuk',[$today_start,$today_end])->whereHas('kasus', function($q){
                    $q->from(app('config.db_name').'_kasus.kasus')->whereNull('krs_at');
                })->pluck('kasus_id')->toArray();

            }

        $data['kasus_id'] = $kasus_id;

        return $data;
    }

    private function generateNoSEP($date)
    {
        $faker = Faker::create('id_ID');
        $prefix = $date->format('Ymd');
        return $prefix.$faker->nik();
    }

    private function doKrs($kasus_id_krs)
    {

        echo "\n\n----KRS : ".count($kasus_id_krs)."----\n";
        $faker = Faker::create('id_ID');
        foreach($kasus_id_krs as $kasus_id)
        {
            $kasus = Kasus::find($kasus_id);

            $now = Carbon::now();
            Carbon::setTestNow($now->startOfDay());
            $tgl_krs = Carbon::now();

            if($kasus->mrs_at > $tgl_krs) continue;

            $death_date = null;
            $death_time = null;

            if($kasus->tipe_rj == 1 && $kasus->tipe_ri == 0) $random = $faker->numberBetween(1,7);
            else $random = $faker->numberBetween(1,10);

            if($random >= 0 && $random <= 5) $krs_status = 'Membaik';
            if($random >=6 && $random <= 7) $krs_status = 'Sakit';

            if($random >= 8) {
                $krs_status = 'Meninggal';
                $death_date =Carbon::now()->format('d-m-Y');
                $death_time =Carbon::now()->format('H:i');
                $alasan_krs = 'Selesai Pelayanan';
            }
            else
            {
                if($random <= 9) $alasan_krs = 'Selesai Pelayanan';
                if($random >= 10) $alasan_krs = 'APS';
            }

            $req = new \Illuminate\Http\Request();
            $req->replace([
                'alasan_krs' => $alasan_krs,
                'status_krs' => $krs_status,
                'krs_keterangan' => null,
                'krs_by' => 1,
                'death_date' => $death_date,
                'death_time' => $death_time,
                'from_scheduler' => 1
            ]);


            app('App\Http\Controllers\Kasus\Pengaturan\PostController')->dataKRS($kasus->nomor_kasus,$req);

            echo "KRS KASUS ID : ".$kasus_id."\n";
            //echo "KRS Status : ".$krs_status."\n";
        }
    }

    public function getKasusBeKrs($data)
    {
        $kasus = Kasus::whereDate('created_at','<=',$data['date'])->whereDoesntHave('rawat_inap_transaksi_first',function($q){
            $q->from(app('config.db_name').'_rawat_inap.transaksi');
        })->whereNull('krs_at')->pluck('id')->toArray();

        return $kasus;
    }
}

<?php

namespace App\Console\Commands\DataGenerator;

use Illuminate\Console\Command;
use App\Models\LabPK\Transaksi;
use App\Models\LabPK\TransaksiDetail;
use Carbon\Carbon;
use Faker\Factory as Faker;
use App\Models\Kasus\Kasus;
use Auth;
use DB;

class LabPKTransaksiGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "data-generator:labpk-transaksi-generator {total-px=1} {date_start=0} {date_end=0}";

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
        Auth::loginUsingId(2);
        $count_error = 1;
        
        while($current_date <= $end){
            echo "\n\n ---------------- Start :".$current_date->format('d-m-Y')."-----------------\n";

            $new_kasus_ids_ri = [];
            $kasus_id_krs = [];
            Carbon::setTestNow($current_date);
            $kasus_ids = Kasus::get()->random($total_px)->pluck('id')->toArray();

            $data['date'] = $current_date;
            foreach($kasus_ids as $index=> $kasus_id){


                try {
                    DB::connection('kasus')->beginTransaction();
                    DB::connection('keuangan')->beginTransaction();
                    DB::connection('lab_pk')->beginTransaction();
                    $kasus = Kasus::find($kasus_id);
                    $tarif = [1468,1518];
                    if($kasus->kelas_id == 0 || empty($kasus->kelas_id)) $kelas_id = 3;
                    else $kelas_id = $kasus->kelas_id;

                    $data = new \Illuminate\Http\Request();
                    $data->replace([
                        'pasien' => $kasus->pasien_id,
                        'kasus_id' => $kasus->id,
                        'sep_id' => null,
                        'sep_num' => null,
                        'tujuan_permintaan' => 3,
                        'tipe_layanan' => 1,
                        'kirim_kasir' => 0,
                        'kelas_pasien' => $kelas_id,
                        'asal_ruang' => $kasus->lokasi->lokasi->id ?? 26,
                        'kasus' => $kasus,
                        'layanan' => $tarif,
                        'keterangan' => 'generate',
                        'keterangan_permintaan' => 'generate',
                        'services' => $tarif,
                        'pasien_id' => $kasus->pasien_id,
                        "pasien_pembayaran_id" => $kasus->pasien_pembayaran_id
                    ]);
                    $transaksi = app('App\Http\Controllers\LabPK\Transaksi\CreateController')->APICreate($data);

                    $transaksi_detail = TransaksiDetail::where('transaksi_id',$transaksi->id)->get();
                    $transaksi_detail_id = $transaksi_detail->pluck('id')->toArray();
                    $jumlah_periksa = [];
                    foreach($transaksi_detail_id as $item)
                    {
                        $jumlah_periksa[$item] = 1;
                    }

                    $layanan_ids = [];
                    foreach($transaksi_detail as $item)
                    {
                        $layanan_ids[$item->id] = $item->tarif_id;
                    }


                    $result_data = new \Illuminate\Http\Request();
                    $result_data->replace([
                        'transaction_slug' => $transaksi->slug,
                        'layanan' => $transaksi_detail_id,
                        'jumlah_periksa' => $jumlah_periksa,
                        "gol_darah" => null,
                        "diagnosis" => null,
                        "infeksi_karbapenemase" => "Tidak Terjadi Infeksi",
                        "infeksi_esbl" => "Tidak Terjadi Infeksi",
                        "layanan_id" => $layanan_ids,
                    ]);
                    $transaksi_create = app('App\Http\Controllers\LabPK\Transaksi\CreateController')->createResult($result_data);
                    $transaksi = app('App\Http\Controllers\LabPK\Transaksi\EditController')->verifikasi($result_data,$transaksi->slug);
                    DB::connection('keuangan')->commit();
                    DB::connection('kasus')->commit();
                    DB::connection('lab_pk')->commit();
                } catch (\Exception $e) {
                    DB::connection('keuangan')->rollback();
                    DB::connection('kasus')->rollback();
                    DB::connection('lab_pk')->rollback();
                    echo 'Gagal-'.$count_error++;

                }
            }

            $current_date->addDay();

        }
    }
}

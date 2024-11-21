<?php

namespace App\Console\Commands\DataGenerator;

use Illuminate\Console\Command;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Farmasi\Farmasi;
use Carbon\Carbon;
use Auth;
use App\Models\Kasus\Kasus;
use DB;

class FarmasiTransaksiGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "data-generator:farmasi-transaksi-generator {total-px=1} {date_start=0} {date_end=0}";

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

        if ($date_start != 0) $start = Carbon::createFromFormat('d-m-Y', $date_start)->startOfDay();
        else $start = Carbon::now();

        if ($date_end != 0) $end = Carbon::createFromFormat('d-m-Y', $date_end)->endOfDay();
        else $end = Carbon::now()->endOfDay();

        $today = Carbon::today()->startOfDay();
        $start_date = $start;
        $current_date = $start->copy()->addHours(1);
        Auth::loginUsingId(2);
        $count_error = 1;

        while ($current_date <= $end) {
            echo "\n\n ---------------- Start :" . $current_date->format('d-m-Y') . "-----------------\n";

            $new_kasus_ids_ri = [];
            $kasus_id_krs = [];
            Carbon::setTestNow($current_date);
            $kasus_ids = Kasus::get()->random($total_px)->pluck('id')->toArray();

            $data['date'] = $current_date;
            foreach ($kasus_ids as $index => $kasus_id) {
                try {
                    DB::connection('kasus')->beginTransaction();
                    DB::connection('keuangan')->beginTransaction();
                    DB::connection('farmasi')->beginTransaction();
                    $kasus = Kasus::find($kasus_id);



                    $current_date->startOfDay()->addHours(1);
                    Carbon::setTestNow($current_date);

                    $obat_fornas = ['362', '222', '107'];
                    $obat_formularium_rs = ['158', '222', '107'];
                    $obat_fornas_formularium_rs = ['222', '107'];
                    $array_nama_obat = [];
                    $array_kategori_obat = [];
                    $array_tipe_obat = [];
                    $array_jumlah_obat = [];
                    $array_racikan_obat = [];
                    $array_aturan_obat = [];
                    $array_id_obat = [];
                    $array_racikan_detail_id_obat = [];
                    $array_racikan_detail_jumlah_obat = [];
                    $array_racikan_detail_nama_obat = [];

                    $nama_apotek = 2;
                    $random = rand(1, 2);
                    if ($random == 1) $total_obat = 2;
                    else $total_obat = 3;
                    $is_racikan_exist = 0;

                    for ($i = 0; $i < $total_obat; $i++) {
                        $random = rand(1, 9);
                        if ($random <= 3) {
                            $random_obat = $obat_fornas;
                            $kategori_check = "fornas";
                        } elseif ($random <= 6) {
                            $random_obat = $obat_formularium_rs;
                            $kategori_check = "formularium_rs";
                        } elseif ($random <= 9) {
                            $random_obat = $obat_fornas_formularium_rs;
                            $kategori_check = "fornas_formularium_rs";
                        }

                        $random = rand(1, 10);
                        if ($random <= 2) $is_racikan = 1;
                        else $is_racikan = 0;

                        if ($is_racikan == 1) $is_racikan_exist = 1;

                        if ($is_racikan) {
                            $id_obat_racikan_array = [];
                            $jumlah_obat_racikan_array = [];
                            $nama_obat_racikan_array = [];
                            foreach ($random_obat as $obat_id) {
                                $obat = ItemsTemplate::find($obat_id);
                                $id_obat_racikan_array[] = $obat_id;
                                $jumlah_obat_racikan_array[] = "12";
                                $nama_obat_racikan_array[] = $obat->nama;
                            }
                            $id_obat_racikan_json = json_encode($id_obat_racikan_array);
                            $jumlah_obat_racikan_json = json_encode($jumlah_obat_racikan_array);
                            $nama_obat_racikan_json = json_encode($nama_obat_racikan_array);

                            $obat = ItemsTemplate::find($obat_id);
                            $array_kategori_obat[] = "racikan";
                            $array_nama_obat[] = null;
                            $array_tipe_obat[] = "Tablet";
                            $array_jumlah_obat[] = "12";
                            $array_racikan_obat[] = "Paket Racikan " . $kategori_check;
                            $array_aturan_obat[] = "3x1";
                            $array_id_obat[] = null;
                            $array_racikan_detail_id_obat[] = $id_obat_racikan_json;
                            $array_racikan_detail_jumlah_obat[] = $jumlah_obat_racikan_json;
                            $array_racikan_detail_nama_obat[] = $nama_obat_racikan_json;
                        } else {
                            $count_array = count($random_obat) - 1;
                            $random = rand(0, $count_array);
                            $obat_id = $random_obat[$random];

                            $obat = ItemsTemplate::find($obat_id);
                            $array_kategori_obat[] = "generik";
                            $array_nama_obat[] = $obat->nama;
                            $array_tipe_obat[] = $obat->satuan;
                            $array_jumlah_obat[] = "12";
                            $array_racikan_obat[] = "";
                            $array_aturan_obat[] = "3x1";
                            $array_id_obat[] = $obat->id;
                            $array_racikan_detail_id_obat[] = "[]";
                            $array_racikan_detail_jumlah_obat[] = "[]";
                            $array_racikan_detail_nama_obat[] = "[]";
                        }
                    }

                    $request = new \Illuminate\Http\Request();
                    $request->replace([
                        'pasien' => $kasus->pasien_id,
                        'metode_pembayaran' => $kasus->pasien_pembayaran_id,
                        'nama-apotek' => $nama_apotek,
                        'jenis_resep' => "standard",
                        'kirim-farmasi' => "on",
                        'dokter-jenis' => "rsal",
                        'dokter-rsal' => "3",
                        'nama-obat' => $array_nama_obat,
                        'kategori-obat' => $array_kategori_obat,
                        'tipe-obat' => $array_tipe_obat,
                        'jumlah-obat' => $array_jumlah_obat,
                        'racikan' => $array_racikan_obat,
                        'aturan-obat' => $array_aturan_obat,
                        'id-obat' => $array_id_obat,
                        'racikan-detail-obat' => $array_racikan_detail_id_obat,
                        'racikan-detail-jumlah-obat' => $array_racikan_detail_jumlah_obat,
                        'racikan-detail-nama-obat' => $array_racikan_detail_nama_obat,
                        'kasus' => $kasus,
                    ]);
                    app('App\Http\Controllers\Kasus\Resep\CreateController')->createNewResep($kasus->nomor_kasus, $request);

                    $transaksi_obat = TransaksiObat::orderBy('id', 'desc')->first();
                    $farmasi = Farmasi::where('id', $nama_apotek)->first();

                    if ($is_racikan_exist) $random_time = rand(60, 180);
                    else $random_time = rand(15, 90);

                    $current_date->addMinutes($random_time);
                    Carbon::setTestNow($current_date);

                    $current_dikerjakan = Carbon::now();

                    $transaksi_obat->dikerjakan_at = $current_dikerjakan;
                    $transaksi_obat->save();

                    if ($is_racikan_exist) $random_time = rand(60, 180);
                    else $random_time = rand(15, 90);

                    $current_date->addMinutes($random_time);
                    Carbon::setTestNow($current_date);

                    $request = new \Illuminate\Http\Request();
                    $request->replace([
                        'laba' => [0, 0, 0],
                        'embalase' => 0,
                        'id' => $transaksi_obat->id,
                        'farmasi' => $farmasi->slug,
                        'total-harga' => $transaksi_obat->total_biaya_obat,
                        'status_pembayaran' => "on",
                        'pembayaran' => null,
                        'shift_id' => 2,
                    ]);

                    $random = rand(1, 10);

                    if ($random >= 2) {
                        app('App\Http\Controllers\Farmasi\Transaksi\EditController')->payment($request);
                    }

                    DB::connection('keuangan')->commit();
                    DB::connection('kasus')->commit();
                    DB::connection('farmasi')->commit();
                } catch (\Exception $e) {
                    DB::connection('keuangan')->rollback();
                    DB::connection('kasus')->rollback();
                    DB::connection('farmasi')->rollback();
                    echo 'Gagal-' . $count_error++;
                }
            }

            $current_date->addDay();
        }
    }

    public function updateAnalisa()
    {
        $query = 'UPDATE resep
        SET analisa_resep_at = created_at,
        analisa_by = 3,
        analisa_resep_sep = IF((FLOOR( 1 + RAND( ) *10 )) > 1,1,0),
        analisa_resep_fotokopi_kartu = IF((FLOOR( 1 + RAND( ) *10 )) > 1,1,0),
        analisa_resep_identitas_pasien = IF((FLOOR( 1 + RAND( ) *10 )) > 1,1,0),
        analisa_resep_paraf_dokter = IF((FLOOR( 1 + RAND( ) *10 )) > 1,1,0),
        analisa_resep_nama_obat = IF((FLOOR( 1 + RAND( ) *10 )) > 1,1,0),
        analisa_resep_jumlah_obat = IF((FLOOR( 1 + RAND( ) *10 )) > 1,1,0),
        analisa_resep_signa_obat = IF((FLOOR( 1 + RAND( ) *10 )) > 1,1,0),
        analisa_resep_tepat_indikasi = IF((FLOOR( 1 + RAND( ) *10 )) > 1,1,0),
        analisa_resep_tepat_dosis = IF((FLOOR( 1 + RAND( ) *10 )) > 1,1,0),
        analisa_resep_tepat_rute = IF((FLOOR( 1 + RAND( ) *10 )) > 1,1,0),
        analisa_resep_tepat_waktu = IF((FLOOR( 1 + RAND( ) *10 )) > 1,1,0),
        analisa_resep_duplikasi_terapi = IF((FLOOR( 1 + RAND( ) *10 )) > 1,1,0),
        analisa_resep_alergi_obat = IF((FLOOR( 1 + RAND( ) *10 )) > 1,1,0),
        analisa_resep_interaksi_obat = IF((FLOOR( 1 + RAND( ) *10 )) > 1,1,0),
        analisa_resep_kontra_indikasi = IF((FLOOR( 1 + RAND( ) *10 )) > 1,1,0)
        ';
    }
}

<?php

namespace App\Console\Commands\DataGenerator;

use Illuminate\Console\Command;
use Faker\Factory as Faker;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\AlamatKota;
use App\Models\Pasien\AlamatKecamatan;
use App\Models\Pasien\AlamatKelurahan;
use App\Models\Pasien\JenisPekerjaan;
use App\Models\Pasien\PembayaranPerusahaan;

class PasienGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data-generator:pasien {total=1}';

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
        $total = $arguments['total'];

        $faker = Faker::create('id_ID');

        for($i=1;$i<=$total;$i++){
            $temp_kelurahan = AlamatKelurahan::all()->random(1)->first();
            $temp_kecamatan = $temp_kelurahan->kecamatan_id;
            $temp_kota = $temp_kelurahan->kecamatan->city_id;
            $temp_kelurahan = $temp_kelurahan->id;

            $temp_negara = $faker->country;
            $temp_suku = array("Jawa", "Cina", "Madura", "Arab", $temp_negara);
            $temp_bahasa = array("Jawa", "Indonesia", "Madura", "Inggris", $temp_negara);
            $random_suku = $temp_suku[$faker->numberBetween(0,4)];
            $random_bahasa = $temp_bahasa[$faker->numberBetween(0,4)];

            $temp_jenis_pekerjaan = JenisPekerjaan::all()->random(1)->first()->nama;
            $perusahaan_pembayaran_id = PembayaranPerusahaan::all()->random(1)->first()->id;

            $pasien_data = new \Illuminate\Http\Request();
            $pasien_data->replace([
                'jenis_kartu_identitas' => 1,
                'nomor_identitas' => $faker->nik(),
                'name' => $faker->name,
                'gender' => $faker->numberBetween(1,2),
                'marriage' => $faker->numberBetween(1,3),
                'birthplace' => $faker->city,
                'birthdate' => $faker->dateTimeBetween('-80 years', 'now')->format('Y-m-d'),
                'address' => $faker->address,
                'city' => $temp_kota,
                'district' => $temp_kecamatan,
                'kelurahan' => $temp_kelurahan,
                'phone' => $faker->phoneNumber,
                'occupation' => $temp_jenis_pekerjaan,
                'agama' => $faker->numberBetween(1,5),
                'bahasa' => $random_bahasa,
                'suku' => $random_suku,
                'pendidikan' => $faker->numberBetween(1,14),
                'is_anggota' => 0,

                'nameKerabat' => $faker->name,
                'genderKerabat' => $faker->numberBetween(1,2),
                'addressKerabat' => $faker->address,
                'relativeTypeKerabat' => $faker->numberBetween(1,6),

                'nomor_asuransi' => $faker->numberBetween(100000000,999999999),
                'perusahaan_pembayaran_id' => $perusahaan_pembayaran_id,
                'kelas' => $faker->numberBetween(1,3)
            ]);
            app('App\Http\Controllers\Pasien\Pasien\PostController')->APICreatePasien($pasien_data);
            echo 'done--'.$i."\n";
        }



    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataMasterLaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $data = [
            [
                "nama" => "Data Rincian - IGD",
                "url" => "pasien/laporan-v2/page/data-rincian-igd",
                "departemen_id" => "1",
                "tags" => "Rincian, Data",
            ],
            [
                "nama" => "Data Rincian - Rawat Inap",
                "url" => "pasien/laporan-v2/page/data-rincian-rawat-inap",
                "departemen_id" => "3",
                "tags" => "Rincian, Data",
            ],
            [
                "nama" => "Data Rincian - Rawat Jalan",
                "url" => "pasien/laporan-v2/page/data-rincian-rawat-jalan",
                "departemen_id" => "2",
                "tags" => "Rincian, Data",
            ],
            [
                "nama" => "Data Rincian - Medical Checkup",
                "url" => "pasien/laporan-v2/page/data-rincian-medical-checkup",
                "departemen_id" => "4",
                "tags" => "Rincian, Data",
            ],
            [
                "nama" => "RL 1.3 Tempat Tidur",
                "url" => "pasien/laporan-v2/page/rl-13-tempat-tidur",
                "departemen_id" => "3",
                "tags" => "RL, SIRS",
            ],
            [
                "nama" => "RL 3.6 Pembedahan",
                "url" => "pasien/laporan-v2/page/rl-36-pembedahan",
                "departemen_id" => "5",
                "tags" => "RL, SIRS",
            ],
            [
                "nama" => "RL 3.7 Radiologi",
                "url" => "pasien/laporan-v2/page/rl-37-radiologi",
                "departemen_id" => "8",
                "tags" => "RL, SIRS",
            ],
            [
                "nama" => "RL 3.8 Laboratorium",
                "url" => "pasien/laporan-v2/page/rl-38-laboratorium",
                "departemen_id" => "6",
                "tags" => "RL, SIRS",
            ],
            [
                "nama" => "RL 5.1 Pengunjung",
                "url" => "pasien/laporan-v2/page/rl-51-pengunjung",
                "departemen_id" => "14",
                "tags" => "RL",
            ],
            [
                "nama" => "RL 5.3 10 Besar Penyakit Rawat Inap",
                "url" => "pasien/laporan-v2/page/rl-53-10-besar-penyakit-ranap",
                "departemen_id" => "3",
                "tags" => "RL",
            ],
            [
                "nama" => "RL 5.4 10 Besar Penyakit Rawat Jalan",
                "url" => "pasien/laporan-v2/page/rl-54-10-besar-penyakit-rajal",
                "departemen_id" => "2",
                "tags" => "RL",
            ],
            [
                "nama" => "RL 3.3 Gigi Mulut",
                "url" => "pasien/laporan-v2/page/rl-33-gigi-mulut",
                "departemen_id" => "2",
                "tags" => "RL, SIRS",
            ],
            [
                "nama" => "RL 3.9 Rehab Medik",
                "url" => "pasien/laporan-v2/page/rl-39-rehab-medik",
                "departemen_id" => "2",
                "tags" => "RL, SIRS",
            ],
            [
                "nama" => "RL 3.10 Pelayanan Khusus",
                "url" => "pasien/laporan-v2/page/rl-310-pelayanan-khusus",
                "departemen_id" => "2",
                "tags" => "RL, SIRS",
            ],
            [
                "nama" => "RL 3.11 Kesehatan Jiwa",
                "url" => "pasien/laporan-v2/page/rl-311-kesehatan-jiwa",
                "departemen_id" => "2",
                "tags" => "RL, SIRS",
            ],
            [
                "nama" => "RL 3.13a Obat Pengadaan",
                "url" => "pasien/laporan-v2/page/rl-313a-obat-pengadaan",
                "departemen_id" => "10",
                "tags" => "RL",
            ],
            [
                "nama" => "RL 3.13b Obat Pelayanan Resep",
                "url" => "pasien/laporan-v2/page/rl-313b-obat-pelayanan-resep",
                "departemen_id" => "10",
                "tags" => "RL",
            ],
            [
                "nama" => "RL 3.15 Cara Bayar",
                "url" => "pasien/laporan-v2/page/rl-315-cara-bayar",
                "departemen_id" => "11",
                "tags" => "RL, SIRS",
            ],
            [
                "nama" => "RL 4 Penyakit Rawat Inap",
                "url" => "pasien/laporan-v2/page/rl-4-penyakit-rawat-inap",
                "departemen_id" => "3",
                "tags" => "RL",
            ],
            [
                "nama" => "RL 4 Penyakit Rawat Jalan",
                "url" => "pasien/laporan-v2/page/rl-4-penyakit-rawat-jalan",
                "departemen_id" => "2",
                "tags" => "RL",
            ],
            [
                "nama" => "RL 1.2_Indikator Pelayanan",
                "url" => "pasien/laporan-v2/page/rl-1-2-indikator-pelayanan",
                "departemen_id" => "3",
                "tags" => "RL",
            ],
            [
                "nama" => "RL 3.1_Rawat inap",
                "url" => "pasien/laporan-v2/page/rl-3-1-rawat-inap",
                "departemen_id" => "3",
                "tags" => "RL",
            ],
            [
                "nama" => "RL 3.2_Rawat darurat",
                "url" => "pasien/laporan-v2/page/rl-3-2-rawat-darurat",
                "departemen_id" => "1",
                "tags" => "RL",
            ],
            [
                "nama" => "RL 5.2 Kunjungan Rawat Jalan",
                "url" => "pasien/laporan-v2/page/rl-52-kunjungan-rawat-jalan",
                "departemen_id" => "2",
                "tags" => "RL",
            ],
            [
                "nama" => "RL 5.2.1 Kunjungan Rawat Inap",
                "url" => "pasien/laporan-v2/page/rl-521-kunjungan-rawat-inap",
                "departemen_id" => "3",
                "tags" => "RL",
            ],
            [
                "nama" => "RL 5.2.2 Kunjungan Gangguan Jiwa",
                "url" => "pasien/laporan-v2/page/rl-522-kunjungan-gangguan-jiwa",
                "departemen_id" => "2",
                "tags" => "RL",
            ],
            [
                "nama" => "Laporan Surveilans Covid",
                "url" => "pasien/laporan-v2/page/laporan-surveilans-covid",
                "departemen_id" => "14",
                "tags" => "Covid",
            ],
            [
                "nama" => "RL 3.14 Rujukan",
                "url" => "pasien/laporan-v2/page/rl-314-rujukan",
                "departemen_id" => "14",
                "tags" => "RL",
            ],
            [
                "nama" => "RL 3.4 Kebidanan",
                "url" => "pasien/laporan-v2/page/rl-34-kebidanan",
                "departemen_id" => "14",
                "tags" => "RL",
            ],
            [
                "nama" => "Rawat Inap - Laporan 10 Besar Penyakit Per Bangsal",
                "url" => "pasien/laporan-v2/page/rawat-inap-laporan-10-besar-penyakit-per-bangsal",
                "departemen_id" => "3",
                "tags" => "Rincian, Data",
            ],
            [
                "nama" => "Rawat Jalan - Laporan 10 Besar Penyakit Per Klinik",
                "url" => "pasien/laporan-v2/page/rawat-jalan-laporan-10-besar-penyakit-per-klinik",
                "departemen_id" => "2",
                "tags" => "Rincian, Data",
            ],
            [
                "nama" => "IGD - Laporan 10 Besar Penyakit",
                "url" => "pasien/laporan-v2/page/igd-laporan-10-besar-penyakit",
                "departemen_id" => "1",
                "tags" => "Rincian, Data",
            ],
            [
                "nama" => "DKK - 4. Laporan Mingguan W2 RS",
                "url" => "pasien/laporan-v2/page/dkk-4-laporan-mingguan-w2-rs",
                "departemen_id" => "14",
                "tags" => "DKK",
            ],
            [
                "nama" => "Rawat Inap - Indikator Pelayanan Per Bangsal",
                "url" => "pasien/laporan-v2/page/indikator-pelayanan-per-bangsal",
                "departemen_id" => "3",
                "tags" => "Rincian, Data",
            ],
            [
                "nama" => "DKK 34 Laporan Bulanan Diare",
                "url" => "pasien/laporan-v2/page/dkk-34-laporan-bulanan-diare",
                "departemen_id" => "14",
                "tags" => "DKK",
            ],
            [
                "nama" => "DKK @ 7. Laporan Bulanan Katarak",
                "url" => "pasien/laporan-v2/page/dkk-7-laporan-bulanan-katarak",
                "departemen_id" => "14",
                "tags" => "DKK",
            ],
            [
                "nama" => "DKK 33. Laporan Bulanan ISPA",
                "url" => "pasien/laporan-v2/page/dkk-33-laporan-bulanan-ispa",
                "departemen_id" => "14",
                "tags" => "DKK",
            ],
            [
                "nama" => "DKK - 19. Laporan Bulanan Kematian RS",
                "url" => "pasien/laporan-v2/page/dkk-19-laporan-bulanan-kematian-rs",
                "departemen_id" => "14",
                "tags" => "DKK",
            ],
            [
                "nama" => "DKK - 22. Laporan Bulanan STP Rawat Jalan",
                "url" => "pasien/laporan-v2/page/dkk-22-laporan-bulanan-stp-rawat-jalan",
                "departemen_id" => "14",
                "tags" => "DKK",
            ],
            [
                "nama" => "DKK - 23. Laporan Bulanan STP Rawat Inap",
                "url" => "pasien/laporan-v2/page/dkk-23-laporan-bulanan-stp-rawat-inap",
                "departemen_id" => "14",
                "tags" => "DKK",
            ],
            [
                "nama" => "DKK - 18. Laporan Bulanan Pelayanan Geriatri",
                "url" => "pasien/laporan-v2/page/dkk-18-laporan-bulanan-pelayanan-geriatri",
                "departemen_id" => "14",
                "tags" => "DKK",
            ],
            [
                "nama" => "DKK - 5. Laporan Bulanan Kunjungan Rawat Jalan Penderita Baru & Lama P2PTM & Keswa",
                "url" => "pasien/laporan-v2/page/dkk-5-laporan-bulanan-kunjungan-rawat-jalan-penderita-baru-lama-p2ptm-keswa",
                "departemen_id" => "14",
                "tags" => "DKK",
            ],
            [
                "nama" => "DKK - 11. Laporan Bulanan Persalinan",
                "url" => "pasien/laporan-v2/page/dkk-11-laporan-bulanan-persalinan",
                "departemen_id" => "14",
                "tags" => "DKK",
            ],
            [
                "nama" => "DKK - 15. Laporan Bulanan Lahir Mati",
                "url" => "pasien/laporan-v2/page/dkk-15-laporan-bulanan-lahir-mati",
                "departemen_id" => "14",
                "tags" => "DKK",
            ],
            [
                "nama" => "DKK - 10. Laporan Bulanan Kematian Ibu",
                "url" => "pasien/laporan-v2/page/dkk-10-laporan-bulanan-kematian-ibu",
                "departemen_id" => "14",
                "tags" => "DKK",
            ],
            [
                "nama" => "RL 3.5 Perinatologi",
                "url" => "pasien/laporan-v2/page/rl-35-perinatologi",
                "departemen_id" => "6",
                "tags" => "RL, SIRS",
            ]
        ];

        DB::connection('mysql')->table('master_laporan')->insert($data);
    }
}

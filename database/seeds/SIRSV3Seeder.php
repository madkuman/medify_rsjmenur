<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SIRSV3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $data[] = $this->apiList();

        foreach ($data as $item) {
            foreach ($item['data'] as $item_data) {
                if (DB::connection($item['connection'])->table($item['table'])->where($item['unique_column'], $item_data[$item['unique_column']])->count() != 0) continue;
                DB::connection($item['connection'])->table($item['table'])->insert($item_data);
            }
        }
    }

    private function apiList()
    {
        return [
            'connection' => 'sirs',
            'table' => 'api_list',
            'unique_column' => 'slug',
            'data' => [
                [
                    'slug' => 'rslogin',
                    'method' => 'POST',
                    'url' => '/api/rslogin',
                ],
                [
                    'slug' => 'laporan-covid-19-add',
                    'method' => 'POST',
                    'url' => '/api/laporancovid19versi3',
                ],
                [
                    'slug' => 'laporan-covid-19-update',
                    'method' => 'PATCH',
                    'url' => '/api/laporancovid19versi3/{id}',
                ],
                [
                    'slug' => 'laporan-covid-19-read-single',
                    'method' => 'GET',
                    'url' => '/api/laporancovid19versi3/{id}',
                ],
                [
                    'slug' => 'laporan-covid-19-diagnosa-add',
                    'method' => 'POST',
                    'url' => '/api/laporancovid19versi3diagnosa',
                ],
                [
                    'slug' => 'laporan-covid-19-diagnosa-update',
                    'method' => 'PATCH',
                    'url' => '/api/laporancovid19versi3diagnosa',
                ],
                [
                    'slug' => 'laporan-covid-19-diagnosa-read-single',
                    'method' => 'GET',
                    'url' => '/api/laporancovid19versi3diagnosa/{id}',
                ],
                [
                    'slug' => 'laporan-covid-19-komorbid-add',
                    'method' => 'POST',
                    'url' => '/api/laporancovid19versi3komorbid',
                ],
                [
                    'slug' => 'laporan-covid-19-komorbid-update',
                    'method' => 'PATCH',
                    'url' => '/api/laporancovid19versi3komorbid',
                ],
                [
                    'slug' => 'laporan-covid-19-komorbid-read-single',
                    'method' => 'GET',
                    'url' => '/api/laporancovid19versi3komorbid/{id}',
                ],
                [
                    'slug' => 'laporan-covid-19-terapi-add',
                    'method' => 'POST',
                    'url' => '/api/laporancovid19versi3terapi',
                ],
                [
                    'slug' => 'laporan-covid-19-terapi-update',
                    'method' => 'PATCH',
                    'url' => '/api/laporancovid19versi3terapi',
                ],
                [
                    'slug' => 'laporan-covid-19-terapi-read-single',
                    'method' => 'GET',
                    'url' => '/api/laporancovid19versi3terapi/{id}',
                ],
                [
                    'slug' => 'laporan-covid-19-vaksinasi-add',
                    'method' => 'POST',
                    'url' => '/api/laporancovid19versi3vaksinasi',
                ],
                [
                    'slug' => 'laporan-covid-19-vaksinasi-update',
                    'method' => 'PATCH',
                    'url' => '/api/laporancovid19versi3vaksinasi',
                ],
                [
                    'slug' => 'laporan-covid-19-vaksinasi-read-single',
                    'method' => 'GET',
                    'url' => '/api/laporancovid19versi3vaksinasi/{id}',
                ],
                [
                    'slug' => 'laporan-covid-19-status-keluar-update',
                    'method' => 'POST',
                    'url' => '/api/laporancovid19versi3statuskeluar',
                ],
                [
                    'slug' => 'master-kewarganegaraan',
                    'method' => 'GET',
                    'url' => '/api/kewarganegaraan',
                    'connection' => 'patients',
                    'tabel' => 'jenis_kewarganegaraan',
                    'kolom_values' => json_encode(['id' => 'sirs_kewarganegaraan_id', 'nicename' => 'nama']),
                    'kolom_comparing' => json_encode(['nicename' => 'nama']),
                    'auto_sync' => 1,
                ],
                [
                    'slug' => 'master-asalpasien',
                    'method' => 'GET',
                    'url' => '/api/asalpasien',
                    'connection' => 'sirs',
                    'tabel' => 'master_asalpasien',
                    'kolom_comparing' => json_encode(['nama' => 'nama']),
                    'auto_sync' => 1,
                ],
                [
                    'slug' => 'master-jenispasien',
                    'method' => 'GET',
                    'url' => '/api/jenispasien',
                    'connection' => 'mysql',
                    'tabel' => 'lokasi_departemen',
                    'kolom_values' => json_encode(['id' => 'sirs_jenis_pasien_id']),
                    'kolom_comparing' => json_encode(['nama' => 'nama']),
                    'auto_sync' => 1,
                ],
                [
                    'slug' => 'master-statuskeluar',
                    'method' => 'GET',
                    'url' => '/api/statuskeluar',
                    'connection' => 'mysql',
                    'tabel' => 'master_cara_pulang',
                    'kolom_values' => json_encode(['id' => 'sirs_status_keluar_id']),
                ],
                [
                    'slug' => 'master-kelompokgejala',
                    'method' => 'GET',
                    'url' => '/api/kelompokgejala',
                    'connection' => 'sirs',
                    'tabel' => 'master_kelompokgejala',
                    'kolom_comparing' => json_encode(['nama' => 'nama']),
                    'auto_sync' => 1,
                ],
                [
                    'slug' => 'master-pekerjaan',
                    'method' => 'GET',
                    'url' => '/api/pekerjaan',
                    'connection' => 'patients',
                    'tabel' => 'jenis_pekerjaan',
                    'kolom_values' => json_encode(['id' => 'sirs_pekerjaan_id']),
                ],
                [
                    'slug' => 'master-statuspasien',
                    'method' => 'GET',
                    'url' => '/api/statuspasien',
                    'connection' => 'sirs',
                    'tabel' => 'master_statuspasien',
                    'kolom_comparing' => json_encode(['nama' => 'nama']),
                    'auto_sync' => 1,
                ],
                [
                    'slug' => 'master-terapi',
                    'method' => 'GET',
                    'url' => '/api/terapi',
                    'connection' => 'sirs',
                    'tabel' => 'master_terapi',
                    'kolom_comparing' => json_encode(['nama' => 'nama']),
                    'auto_sync' => 1,
                ],
                [
                    'slug' => 'master-kasuskematian',
                    'method' => 'GET',
                    'url' => '/api/kasuskematian',
                    'connection' => 'sirs',
                    'tabel' => 'master_kasuskematian',
                    'kolom_comparing' => json_encode(['nama' => 'nama']),
                    'auto_sync' => 1,
                ],
                [
                    'slug' => 'master-penyebabkematianlangsung',
                    'method' => 'GET',
                    'url' => '/api/penyebabkematianlangsung',
                    'connection' => 'sirs',
                    'tabel' => 'master_penyebabkematianlangsung',
                    'kolom_comparing' => json_encode(['nama' => 'nama']),
                    'auto_sync' => 1,
                ],
                [
                    'slug' => 'master-alatoksigen',
                    'method' => 'GET',
                    'url' => '/api/alatoksigen',
                    'connection' => 'sirs',
                    'tabel' => 'master_alatoksigen',
                    'kolom_comparing' => json_encode(['nama' => 'nama']),
                    'auto_sync' => 1,
                ],
                [
                    'slug' => 'master-dosisvaksin',
                    'method' => 'GET',
                    'url' => '/api/dosisvaksin',
                    'connection' => 'sirs',
                    'tabel' => 'master_dosisvaksin',
                    'kolom_comparing' => json_encode(['nama' => 'nama']),
                    'auto_sync' => 1,
                ],
                [
                    'slug' => 'master-jenisvaksin',
                    'method' => 'GET',
                    'url' => '/api/jenisvaksin',
                    'connection' => 'sirs',
                    'tabel' => 'master_jenisvaksin',
                    'kolom_comparing' => json_encode(['nama' => 'nama']),
                    'auto_sync' => 1,
                ],
                [
                    'slug' => 'master-provinsi',
                    'method' => 'GET',
                    'url' => '/api/provinsi',
                    'connection' => 'patients',
                    'tabel' => 'alamat_provinsi',
                    'kolom_values' => json_encode(['id' => 'sirs_provinsi_id']),
                    'kolom_comparing' => json_encode(['nama' => 'nama']),
                    'auto_sync' => 1,
                ],
                [
                    'slug' => 'master-kabkota',
                    'method' => 'GET',
                    'url' => '/api/kabkota',
                    'connection' => 'patients',
                    'tabel' => 'alamat_kota',
                    'kolom_values' => json_encode(['id' => 'sirs_kabkota_id']),
                    'kolom_comparing' => json_encode(['nama' => 'nama']),
                    'auto_sync' => 1,
                ],
                [
                    'slug' => 'master-kecamatan',
                    'method' => 'GET',
                    'url' => '/api/kecamatan',
                    'connection' => 'patients',
                    'tabel' => 'alamat_kecamatan',
                    'kolom_values' => json_encode(['id' => 'sirs_kecamatan_id']),
                    'kolom_comparing' => json_encode(['nama' => 'nama']),
                    'auto_sync' => 1,
                ],
                [
                    'slug' => 'master-kelurahan',
                    'method' => 'GET',
                    'url' => '/api/kelurahan',
                    'connection' => 'patients',
                    'tabel' => 'alamat_kelurahan',
                    'kolom_values' => json_encode(['id' => 'sirs_kelurahan_id']),
                    'kolom_comparing' => json_encode(['nama' => 'nama']),
                    'auto_sync' => 1,
                ],
            ]
        ];
    }
}

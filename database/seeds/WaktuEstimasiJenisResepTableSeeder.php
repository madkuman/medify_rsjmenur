<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaktuEstimasiJenisResepTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
    			'jenis_resep' => 'Racikan',
    			'waktu_estimasi' => 10,
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'updated_by' => 1,
    		],
            [
    			'jenis_resep' => 'Non Racikan',
    			'waktu_estimasi' => 5,
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'updated_by' => 1,
    		],
        ];

        foreach ($data as $key => $value) {
            DB::connection('farmasi')
                ->table('waktu_estimasi_jenis_resep')
                ->insert($value);
        }
    }
}

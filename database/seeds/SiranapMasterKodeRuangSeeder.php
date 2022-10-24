<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiranapMasterKodeRuangSeeder extends Seeder
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
    			'kode' => '0001',
    			'nama' => 'Super VIP',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0002',
    			'nama' => 'VIP',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0003',
    			'nama' => 'Kelas 1',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0004',
    			'nama' => 'Kelas 2',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0005',
    			'nama' => 'Kelas 3',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0006',
    			'nama' => 'Intermediate',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0007',
    			'nama' => 'Isolasi',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0008',
    			'nama' => 'Rawat Khusus',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    	];

    	foreach ($data as $key => $value) {
	        DB::connection('rawatinap')
	        	->table('siranap_master_kode_ruang')
	        	->insert($value);
    	}
    }
}

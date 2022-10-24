<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiranapMasterTipePasienSeeder extends Seeder
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
    			'kode' => '0000',
    			'nama' => 'Umum',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0001',
    			'nama' => 'Anak',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0002',
    			'nama' => 'Anak (Luka Bakar)',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0003',
    			'nama' => 'Penyakit Dalam',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0004',
    			'nama' => 'Kebidanan',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0005',
    			'nama' => 'Kandungan',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0006',
    			'nama' => 'Bedah',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0007',
    			'nama' => 'Kanker',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0008',
    			'nama' => 'Mata',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0009',
    			'nama' => 'THT',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0010',
    			'nama' => 'Paru',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0011',
    			'nama' => 'Jantung',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0012',
    			'nama' => 'Orthopedi',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0013',
    			'nama' => 'Kulit dan Kelamin',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0014',
    			'nama' => 'Syaraf',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0015',
    			'nama' => 'Jiwa',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0016',
    			'nama' => 'Infeksi',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0017',
    			'nama' => 'Luka Bakar',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0018',
    			'nama' => 'Napza',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0019',
    			'nama' => 'Isolasi Air Borne',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0020',
    			'nama' => 'Isolasi TB MDR',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0021',
    			'nama' => 'Kusta',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0022',
    			'nama' => 'Isolasi Imunitas Menurun',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0023',
    			'nama' => 'Isolasi Radioaktif',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0024',
    			'nama' => 'ICU',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0025',
    			'nama' => 'NICU',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0026',
    			'nama' => 'PICU',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0027',
    			'nama' => 'CVCU/ICCU',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0028',
    			'nama' => 'RICU',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    		[
    			'kode' => '0029',
    			'nama' => 'HCU',
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s'),
    			'deleted_at' => NULL,
    		],
    	];

    	foreach ($data as $key => $value) {
	        DB::connection('rawatinap')
	        	->table('siranap_master_tipe_pasien')
	        	->insert($value);
    	}
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class LaporanRujukanRajalRanapIgdAlterMasterLaporanInsertDataLaporan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('mysql')->table('master_laporan')->insert(
            array(
                'nama' => 'Laporan Asal Rujukan Rawat Jalan',
                'tags' => 'RL',
                'departemen_id' => '2',
                'url' => 'pasien/laporan-v2/page/laporan-asal-rujukan-rajal-ranap-igd',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

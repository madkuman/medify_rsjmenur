<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeederAddLaporanKunjunganUnitTindakan extends Migration
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
                'nama' => 'Laporan Kunjungan Unit Tindakan',
                'tags' => 'Rincian, Data',
                'departemen_id' => '14',
                'url' => 'pasien/laporan-v2/page/laporan-kunjungan-unit-tindakan',
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeederAddLaporanRekapPerdokter extends Migration
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
                'nama' => 'Laporan Rekap Per Dokter',
                'tags' => 'Rincian, Data',
                'departemen_id' => '14',
                'url' => 'pasien/laporan-v2/page/laporan-rekap-perdokter',
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

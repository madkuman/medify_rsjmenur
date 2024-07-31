<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiKategoriResepTransaksiAlterRacikanDetailDispensingAseptik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('racikan_detail', function (Blueprint $table) {
            $table->string('dispensing_aseptik_jenis_racikan', 100)->nullable();
            $table->string('dispensing_aseptik_dosis', 100)->nullable();
            $table->string('dispensing_aseptik_dosis_yang_dibutuhkan', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->table('racikan_detail', function (Blueprint $table) {
            $table->dropColumn([
                'dispensing_aseptik_jenis_racikan',
                'dispensing_aseptik_dosis',
                'dispensing_aseptik_dosis_yang_dibutuhkan',
            ]);
        });
    }
}

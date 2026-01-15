<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiKategoriResepTransaksiAlterResepDetailDispensingAseptik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('resep_detail', function (Blueprint $table) {
            $table->string('dispensing_aseptik_dosis_yang_dibutuhkan', 100)->nullable();
            $table->string('dispensing_aseptik_dosis', 100)->nullable();
            $table->string('dispensing_aseptik_aturan_penggunaan', 100)->nullable();
            $table->string('dispensing_aseptik_catatan', 100)->nullable();
            $table->string('dispensing_aseptik_bud', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->table('resep_detail', function (Blueprint $table) {
            $table->dropColumn([
                'dispensing_aseptik_dosis_yang_dibutuhkan',
                'dispensing_aseptik_dosis',
                'dispensing_aseptik_aturan_penggunaan',
                'dispensing_aseptik_catatan',
                'dispensing_aseptik_bud',
            ]);
        });
    }
}

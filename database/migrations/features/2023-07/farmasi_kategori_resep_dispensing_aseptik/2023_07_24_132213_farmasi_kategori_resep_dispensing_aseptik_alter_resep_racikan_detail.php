<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiKategoriResepDispensingAseptikAlterResepRacikanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('resep_racikan_detail', function (Blueprint $table) {
            $table->string('dispensing_aseptik_jenis_racikan', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->table('resep_racikan_detail', function (Blueprint $table) {
            $table->dropColumn([
                'dispensing_aseptik_jenis_racikan',
            ]);
        });
    }
}

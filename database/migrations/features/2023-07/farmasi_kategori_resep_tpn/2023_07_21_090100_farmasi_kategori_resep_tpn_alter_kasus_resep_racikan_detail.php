<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiKategoriResepTpnAlterKasusResepRacikanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('resep_racikan_detail', function (Blueprint $table) {
            $table->string('tpn_catatan', 100)->nullable();
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
                'tpn_catatan',
            ]);
        });
    }
}

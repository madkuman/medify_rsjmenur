<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiKategoriResepTransaksiAlterRacikanDetailTpn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('racikan_detail', function (Blueprint $table) {
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
        Schema::connection('farmasi')->table('racikan_detail', function (Blueprint $table) {
            $table->dropColumn([
                'tpn_catatan',
            ]);
        });
    }
}

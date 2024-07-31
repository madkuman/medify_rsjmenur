<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiKategoriResepTpnAlterKasusResepDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('resep_detail', function (Blueprint $table) {
            $table->string('tpn_alergi', 100)->nullable();
            $table->double('tpn_berat_badan')->nullable();
            $table->string('tpn_diagnosis', 100)->nullable();
            $table->double('tpn_jumlah_tpn')->nullable();
            $table->string('tpn_kemasan', 100)->nullable();
            $table->string('tpn_rute_pemberian', 100)->nullable();
            $table->string('tpn_aturan_penggunaan', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->table('resep_detail', function (Blueprint $table) {
            $table->dropColumn([
                'tpn_alergi',
                'tpn_berat_badan',
                'tpn_diagnosis',
                'tpn_jumlah_tpn',
                'tpn_kemasan',
                'tpn_rute_pemberian',
                'tpn_aturan_penggunaan',
            ]);
        });
    }
}

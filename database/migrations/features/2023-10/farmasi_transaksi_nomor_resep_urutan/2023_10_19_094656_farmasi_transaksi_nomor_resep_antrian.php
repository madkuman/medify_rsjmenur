<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiTransaksiNomorResepAntrian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('transaksi_obat', function (Blueprint $table) {
            $table->integer('jenis_antrian_id')->nullable()->after('jenis_resep_antrian');
            $table->string('jenis_antrian_kode')->nullable()->after('jenis_antrian_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->table('transaksi_obat', function (Blueprint $table) {
            $table->dropColumn('jenis_antrian_id');
            $table->dropColumn('jenis_antrian_kode');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJamOperasiToTransaksiTableKamaroperasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kamaroperasi')->table('transaksi', function (Blueprint $table) {
            $table->time('jam_operasi')->nullable()->after('jadwal_operasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kamaroperasi')->table('transaksi', function (Blueprint $table) {
            $table->dropColumn('jam_operasi');
        });
    }
}

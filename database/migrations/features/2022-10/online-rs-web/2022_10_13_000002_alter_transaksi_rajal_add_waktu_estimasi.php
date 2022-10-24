<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTransaksiRajalAddWaktuEstimasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rawatjalan')->table('transaksi', function (Blueprint $table) {
            $table->timestamp('waktu_estimasi')->nullable()->after('waktu_pemeriksaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('rawatjalan')->table('transaksi', function (Blueprint $table) {
            $table->dropColumn('waktu_estimasi');
        });
    }
}

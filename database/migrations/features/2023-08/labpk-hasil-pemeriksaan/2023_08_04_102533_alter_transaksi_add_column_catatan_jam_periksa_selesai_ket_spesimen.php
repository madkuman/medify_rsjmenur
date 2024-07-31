<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTransaksiAddColumnCatatanJamPeriksaSelesaiKetSpesimen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('lab_pk')->table('transaksi', function (Blueprint $table) {
            $table->string('jam_diperiksa')->nullable();
            $table->string('jam_selesai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('lab_pk')->table('transaksi', function (Blueprint $table) {
            $table->dropColumn(['jam_diperiksa','jam_selesai']);
        });
    }
}

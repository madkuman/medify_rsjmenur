<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFarmasiTransaksiObat1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('farmasi')->hasColumn('transaksi_obat','waktu_estimasi_selesai')) {
            Schema::connection('farmasi')->table('transaksi_obat', function (Blueprint $table)
            {
                $table->string('jenis_resep_antrian')->nullable();
                $table->string('nomor_antrian')->nullable();
                $table->timestamp('waktu_check_in')->nullable();
                $table->timestamp('waktu_estimasi_selesai')->nullable();
            });
        }        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->table('transaksi_obat', function (Blueprint $table)
        {
            $table->dropColumn('jenis_resep_antrian');
            $table->dropColumn('nomor_antrian');
            $table->dropColumn('waktu_check_in');
            $table->dropColumn('waktu_estimasi_selesai');
        });
    }
}

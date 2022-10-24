<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFarmasiTransaksiObat2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('farmasi')->hasColumn('transaksi_obat','loket_id')) {
            Schema::connection('farmasi')->table('transaksi_obat', function (Blueprint $table)
            {
                $table->integer('loket_id')->nullable();
                $table->integer('status_panggil')->nullable();
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
            $table->dropColumn('loket_id');
            $table->dropColumn('status_panggil');
        });
    }
}

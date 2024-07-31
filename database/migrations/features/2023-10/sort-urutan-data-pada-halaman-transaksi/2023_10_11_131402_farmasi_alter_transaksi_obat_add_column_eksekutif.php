<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiAlterTransaksiObatAddColumnEksekutif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('farmasi')->hasColumn('transaksi_obat', 'eksekutif'))
        {
            Schema::connection('farmasi')->table('transaksi_obat', function (Blueprint $table) {
                $table->tinyInteger('eksekutif')->nullable()->default(0);
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
        Schema::connection('farmasi')->table('transaksi_obat', function (Blueprint $table) {
            $table->dropColumn('eksekutif');
        });
    }
}

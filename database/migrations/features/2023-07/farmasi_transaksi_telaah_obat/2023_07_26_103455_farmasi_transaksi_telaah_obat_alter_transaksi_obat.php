<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiTransaksiTelaahObatAlterTransaksiObat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('transaksi_obat', function (Blueprint $table) {
            $table->integer('telaah_kirim_ruangan')->nullable();
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
            $table->dropColumn([
                'telaah_kirim_ruangan',
            ]);
        });
    }
}

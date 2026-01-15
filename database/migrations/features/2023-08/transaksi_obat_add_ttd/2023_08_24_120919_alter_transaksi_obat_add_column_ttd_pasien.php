<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTransaksiObatAddColumnTtdPasien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('transaksi_obat', function (Blueprint $table) {
            $table->string('nama_ttd')->nullable();
            $table->string('img_ttd')->nullable();
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
            $table->dropColumn(['nama_ttd','img_ttd']);
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiKategoriResepTransaksiAlterResep2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('resep', function (Blueprint $table) {
            $table->timestamp('konfirmasi_permintaan_at')->nullable();
            $table->integer('konfirmasi_permintaan_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->table('resep', function (Blueprint $table) {
            $table->dropColumn([
                'konfirmasi_permintaan_at',
                'konfirmasi_permintaan_by',
            ]);
        });
    }
}

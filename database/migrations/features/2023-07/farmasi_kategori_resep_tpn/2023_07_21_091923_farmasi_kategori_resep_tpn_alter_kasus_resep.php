<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiKategoriResepTpnAlterKasusResep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('resep', function (Blueprint $table) {
            $table->integer('farmasi_id')->nullable();
            $table->integer('cito')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->table('resep', function (Blueprint $table) {
            $table->dropColumn([
                'farmasi_id',
                'cito',
            ]);
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiCatatanPengobatanPasienAlterCatatanPengobatanPasienDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('catatan_pengobatan_pasien_detail', function (Blueprint $table) {
            $table->integer('farmasi_resep_detail_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->table('catatan_pengobatan_pasien_detail', function (Blueprint $table) {
            $table->dropColumn([
                'farmasi_resep_detail_id',
            ]);
        });
    }
}

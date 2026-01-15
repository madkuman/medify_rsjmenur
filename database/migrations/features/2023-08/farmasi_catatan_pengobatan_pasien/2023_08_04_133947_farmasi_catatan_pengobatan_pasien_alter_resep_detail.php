<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiCatatanPengobatanPasienAlterResepDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('resep_detail', function (Blueprint $table) {
            $table->integer('kasus_catatan_pengobatan_pasien_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->table('resep_detail', function (Blueprint $table) {
            $table->dropColumn([
                'kasus_catatan_pengobatan_pasien_id',
            ]);
        });
    }
}

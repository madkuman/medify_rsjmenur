<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePoliklinik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rawatjalan')->table('poliklinik', function (Blueprint $table) {
            $table->integer('sirs_kunjungan_kegiatan')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('rawatjalan')->table('poliklinik', function (Blueprint $table) {
            $table->integer('sirs_kunjungan_kegiatan')->default(0);
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiNomorAntrianAlterJenisAntrian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('jenis_antrian', function (Blueprint $table) {
            $table->string('jenis_resep_antrian')->nullable()->default(0)->comment('karena mengikuti kodingan sebelumnya maka jika nilai 1 = racikan jika selain 1 non racikan');
            $table->integer('lokasi_departemen_id')->nullable()->default(0)->comment('null/0 = semua, -1 lainnya');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->table('jenis_antrian', function (Blueprint $table) {
            $table->dropColumn('jenis_resep_antrian');
            $table->dropColumn('lokasi_departemen_id');
        });
    }
}

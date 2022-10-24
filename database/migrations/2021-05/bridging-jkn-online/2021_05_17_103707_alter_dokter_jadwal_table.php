<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDokterJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::connection('rawatjalan')->table('dokter_jadwal', function ($table) {
            $table->integer('estimasi_pelayanan');
            $table->integer('kuota_bpjs_online')->default(0);
            $table->integer('kuota_all_online')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('rawatjalan')->table('dokter_jadwal', function ($table) {
            $table->dropColumn('estimasi_pelayanan');
            $table->dropColumn('kuota_bpjs_online');
            $table->dropColumn('kuota_all_online');
        });
    }
}

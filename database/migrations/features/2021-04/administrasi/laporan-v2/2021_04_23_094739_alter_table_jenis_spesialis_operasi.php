<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableJenisSpesialisOperasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kamaroperasi')->table('jenis_spesialis_operasi', function (Blueprint $table) {
            $table->integer('sirs_spesialisasi_bedah_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kamaroperasi')->table('jenis_spesialis_operasi', function (Blueprint $table) {
            $table->dropColumn('sirs_spesialisasi_bedah_id');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterKasusBpjsSep1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('bpjs_sep', function (Blueprint $table) {
            $table->string('dinsos')->nullable();
            $table->string('no_sktm')->nullable();
            $table->string('prolanis_prb')->nullable();
            $table->string('tujuan_kunjungan')->nullable();
            $table->string('flag_procedure')->nullable();
            $table->string('poli_tujuan_nama')->after('poli_tujuan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->table('bpjs_sep', function (Blueprint $table) {
            $table->dropColumn([
                'dinsos',
                'no_sktm',
                'prolanis_prb',
                'tujuan_kunjungan',
                'flag_procedure',
                'poli_tujuan_nama',
            ]);
        });
    }
}

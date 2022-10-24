<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRuangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rawatinap')->table('ruangan', function (Blueprint $table) {
            $table->integer('sirs_tempat_tidur_jenis_id')->default(0);
            $table->integer('sirs_tempat_tidur_kelas_id')->default(0);
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
        Schema::connection('rawatinap')->table('ruangan', function (Blueprint $table) {
            $table->dropColumn('sirs_tempat_tidur_jenis_id');
            $table->dropColumn('sirs_tempat_tidur_kelas_id');
            $table->integer('sirs_kunjungan_kegiatan')->default(0);
        });
    }
}

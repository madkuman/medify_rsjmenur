<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMutuKegiatanPengendalian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->create('mutu_kegiatan_pengendalian', function (Blueprint $table) {
            $table->increments('id');
            $table->text('uraian_resiko')->nullable();
            $table->text('kegiatan_standart')->nullable();
            $table->text('kegiatan_terpasang_uraian')->nullable();
            $table->string('kegiatan_terpasang_efektifitas')->nullable();
            $table->text('kegiatan_terpasang_celah')->nullable();
            $table->text('rencana')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->string('target_waktu')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::connection('kasus')->create('mutu_evaluasi_kegiatan_pengendalian', function (Blueprint $table) {
            $table->increments('id');
            $table->text('uraian_resiko')->nullable();
            $table->string('skala_kemungkinan')->nullable();
            $table->string('skala_dampak')->nullable();
            $table->string('skala_status_resiko')->nullable();
            $table->string('kreteria_resiko')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

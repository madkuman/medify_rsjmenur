<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMutuIdentifikasiResiko extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->create('mutu_identifikasi_resiko', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('indikator_id')->nullable();
            $table->text('resiko_sasaran')->nullable();
            $table->text('resiko_uraian')->nullable();
            $table->text('penyebab_uraian')->nullable();
            $table->string('penyebab_intern_ekstern')->nullable();
            $table->string('penerimaan')->nullable();
            $table->text('dampak')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::connection('kasus')->create('mutu_indikator', function (Blueprint $table) {
            $table->increments('id');
            $table->text('judul')->nullable();
            $table->text('kegiatan')->nullable();
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

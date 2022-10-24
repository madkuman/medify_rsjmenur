<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmasiJenisAntrian1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('farmasi')->hasTable('jenis_antrian')) {
            Schema::connection('farmasi')->create('jenis_antrian', function ($table) {
                $table->bigIncrements('id');
                $table->string('nama')->nullable();
                $table->string('kode')->nullable();
                $table->integer('perusahaan_tipe')->nullable();
                $table->integer('created_by')->nullable();
                $table->integer('deleted_by')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->drop('jenis_antrian');
    }
}

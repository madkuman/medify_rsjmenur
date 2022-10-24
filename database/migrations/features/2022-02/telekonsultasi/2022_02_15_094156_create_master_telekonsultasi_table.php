<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterTelekonsultasiTable extends Migration
{
    /**
     * Run the migrartions.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rawatjalan')->create('master_telekonsultasi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poliklinik_id')->nullable();
            $table->integer('tarif_id')->nullable();
            $table->integer('durasi')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::connection('rawatjalan')->dropIfExists('master_telekonsultasi');
    }
}

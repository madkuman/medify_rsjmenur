<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmasiWaktuEstimasiJenisResep1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('farmasi')->hasTable('waktu_estimasi_jenis_resep')) {
            Schema::connection('farmasi')->create('waktu_estimasi_jenis_resep', function ($table) {
                $table->bigIncrements('id');
                $table->string('jenis_resep')->nullable();
                $table->integer('waktu_estimasi')->nullable();
                $table->integer('updated_by')->nullable();
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
        Schema::connection('farmasi')->drop('waktu_estimasi_jenis_resep');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmasiScreenAntrian1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('farmasi')->hasTable('screen_antrian')) {
            Schema::connection('farmasi')->create('screen_antrian', function ($table) {
                $table->bigIncrements('id');
                $table->string('nama')->nullable();
                $table->json('jenis_antrian')->nullable();
                $table->json('jenis_resep')->nullable();
                $table->string('slug')->nullable();
                $table->integer('created_by')->nullable();
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
        Schema::connection('farmasi')->drop('screen_antrian');
    }
}

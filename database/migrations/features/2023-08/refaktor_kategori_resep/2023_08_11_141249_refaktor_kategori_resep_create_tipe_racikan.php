<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefaktorKategoriResepCreateTipeRacikan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('farmasi')->hasTable('tipe_racikan')) {
            Schema::connection('farmasi')->create('tipe_racikan', function (Blueprint $table) {
                $table->increments('id');
                $table->string('slug', 100);
                $table->string('nama', 100);
                $table->integer('is_racikan_default')->default(1);
                $table->integer('beyond_use_date')->nullable();
                $table->timestamps();
                $table->softDeletes();
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
        Schema::connection('farmasi')->dropIfExists('tipe_racikan');
    }
}

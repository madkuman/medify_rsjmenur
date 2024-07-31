<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiKategoriResepCreateAturanEmbalase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('farmasi')->hasTable('aturan_embalase')) {
            Schema::connection('farmasi')->create('aturan_embalase', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('farmasi_id')->nullable();
                $table->integer('perusahaan_tipe_id')->nullable();
                $table->integer('harga_generik')->default(0);
                $table->integer('harga_racikan')->default(0);
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
        Schema::connection('farmasi')->dropIfExists('aturan_embalase');
    }
}

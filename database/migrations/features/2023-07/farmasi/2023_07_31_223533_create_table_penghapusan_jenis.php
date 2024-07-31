<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePenghapusanJenis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->create('penghapusan_jenis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->timestamps();
            $table->integer('created_by');
            $table->integer('deleted_by');
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->dropIfExists('penghapusan_jenis');
    }
}

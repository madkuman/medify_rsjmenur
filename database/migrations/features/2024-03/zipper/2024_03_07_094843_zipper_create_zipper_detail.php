<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ZipperCreateZipperDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('zipper_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('zipper_id')->index();
            $table->integer('referensi_id')->nullable();
            $table->integer('status')->default(0);
            $table->json('data');
            $table->json('log');
            $table->timestamps();
            $table->integer('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('zipper_detail');
    }
}

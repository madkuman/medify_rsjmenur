<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('eusulan')->create('dokumen', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title')->nullable();
            $table->text('path')->nullable();
            $table->text('type')->nullable();
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
        Schema::connection('eusulan')->dropIfExists('dokumen');
    }
}

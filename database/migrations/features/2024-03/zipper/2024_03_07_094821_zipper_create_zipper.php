<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ZipperCreateZipper extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('zipper', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 50);
            $table->string('filename', 255)->nullable();
            $table->string('path', 255)->nullable();
            $table->integer('status')->default(0);
            $table->string('error_message', 255)->nullable();
            $table->timestamp('last_process_at')->nullable();
            $table->float('percentage')->default(0);
            $table->json('param');
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
        Schema::connection('mysql')->dropIfExists('zipper');
    }
}

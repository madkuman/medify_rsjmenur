<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCKasusReadbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->create('readback', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('cppt_id')->nullable();
            $table->unsignedBigInteger('dokter_id')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->boolean('is_read')->default(false);
            $table->mediumText('notes')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->timestamps();
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
        Schema::connection('kasus')->dropIfExists('readback');
    }
}

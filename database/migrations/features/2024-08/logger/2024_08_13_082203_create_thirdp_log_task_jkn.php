<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThirdpLogTaskJkn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('thirdp')->create('log_task_jkn_id', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kodebooking')->nullable();
            $table->integer('task_id')->nullable();
            $table->timestamp('waktu')->nullable();
            $table->text('response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('thirdp')->dropIfExists('log_task_jkn_id');
    }
}

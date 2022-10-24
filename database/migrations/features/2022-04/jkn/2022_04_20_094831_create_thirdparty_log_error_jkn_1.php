<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThirdpartyLogErrorJkn1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('thirdp')->hasTable('log_error_jkn')) {
            Schema::connection('thirdp')->create('log_error_jkn', function ($table) {
                $table->bigIncrements('id');
                $table->integer('kodebooking')->nullable();
                $table->text('response')->nullable();
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
        Schema::connection('thirdp')->dropIfExists('log_error_jkn');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogBundleSatuSehat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('satusehat')->create('log_bundle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kasus_id')->nullable();
            $table->string('encounter_id')->nullable();
            $table->string('resource_type')->nullable();
            $table->longText('param')->nullable();
            $table->longText('response')->nullable();
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
        Schema::connection('satusehat')->dropIfExists('log_bundle');
    }
}

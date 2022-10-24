<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rawatjalan')->create('video', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaksi_id')->nullable();
            $table->string('session_token',255)->nullable();
            $table->integer('is_connecting')->nullable()->default(0);
            $table->integer('is_on')->nullable()->default(0);
            $table->integer('is_connected')->nullable()->default(0);
            $table->integer('is_declined')->nullable()->default(0);
            $table->integer('is_confirmed')->nullable()->default(0);
            $table->integer('created_by')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
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
        Schema::connection('rawatjalan')->dropIfExists('video');
    }
}

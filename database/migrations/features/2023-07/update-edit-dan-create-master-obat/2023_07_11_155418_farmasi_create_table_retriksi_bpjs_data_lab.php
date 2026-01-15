<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiCreateTableRetriksiBpjsDataLab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->create('retriksi_bpjs_data_lab', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('item_template_id')->nullable();
            $table->unsignedBigInteger('form_id')->nullable();

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
        Schema::connection('farmasi')->dropIfExists('retriksi_bpjs_data_lab');
    }
}

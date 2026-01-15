<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterItemTemplateKodeRekeningBidang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('item_template', function (Blueprint $table) {

            $table->integer('kode_rekening_id')->nullable();
            $table->integer('kode_bidang_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->table('item_template', function (Blueprint $table) {
            $table->dropColumn('kode_rekening_id');
            $table->dropColumn('kode_bidang_id');
        });
    }
}

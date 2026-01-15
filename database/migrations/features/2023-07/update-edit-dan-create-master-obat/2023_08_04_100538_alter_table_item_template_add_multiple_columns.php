<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableItemTemplateAddMultipleColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('item_template', function (Blueprint $table) {
            $table->string('kode_barang')->nullable();
            $table->string('kode_atc')->nullable();
            $table->integer('dosis_maksimal')->nullable();
            $table->string('dosis_maksimal_satuan')->nullable();
            $table->string('indikasi')->nullable();
            $table->integer('waktu_dosage_max_1')->nullable();
            $table->integer('waktu_dosage_max_2')->nullable();
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
            $table->dropColumn('kode_barang');
            $table->dropColumn('kode_atc');
            $table->dropColumn('dosis_maksimal');
            $table->dropColumn('dosis_maksimal_satuan');
            $table->dropColumn('indikasi');
            $table->dropColumn('waktu_dosage_max_1');
            $table->dropColumn('waktu_dosage_max_2');
        });
    }
}

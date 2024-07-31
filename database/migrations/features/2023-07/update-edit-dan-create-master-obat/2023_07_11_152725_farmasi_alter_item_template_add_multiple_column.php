<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiAlterItemTemplateAddMultipleColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('item_template', function (Blueprint $table) {

            $table->unsignedBigInteger('rute_id')->nullable();
            $table->unsignedBigInteger('bahan_aktif_id')->nullable();
            $table->integer('kekuatan_sediaan')->nullable();
            $table->unsignedBigInteger('satuan_kekuatan_id')->nullable();

            $table->unsignedBigInteger('kelas_terapi_id')->nullable();
            $table->tinyInteger('is_kelas_terapi')->nullable();

            $table->unsignedBigInteger('kelas_terapi_fornas_id')->nullable();
            $table->tinyInteger('is_kelas_terapi_fornas')->nullable();

            $table->unsignedBigInteger('rak_obat_id')->nullable();
            $table->tinyInteger('is_formularium_rs')->nullable();
            $table->tinyInteger('is_fornas')->nullable();
            $table->integer('retriksi_bpjs_jumlah')->nullable();
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
            $table->dropColumn('rute_id');
            $table->dropColumn('bahan_aktif_id');
            $table->dropColumn('kekuatan_sediaan');
            $table->dropColumn('satuan_kekuatan_id');
            $table->dropColumn('kelas_terapi_id');
            $table->dropColumn('is_kelas_terapi');
            $table->dropColumn('kelas_terapi_fornas_id');
            $table->dropColumn('is_kelas_terapi_fornas');
            $table->dropColumn('rak_obat_id');
            $table->dropColumn('is_formularium_rs');
            $table->dropColumn('is_fornas');
            $table->dropColumn('retriksi_bpjs_jumlah');
        });
    }
}

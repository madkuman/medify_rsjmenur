<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRekonsiliasiObatDetailAddColumnKategoriSediaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('rekonsiliasi_obat_detail', function (Blueprint $table) {
            $table->string('kategori_sediaan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->table('rekonsiliasi_obat_detail', function (Blueprint $table) {
            $table->dropColumn('kategori_sediaan');
        });
    }
}

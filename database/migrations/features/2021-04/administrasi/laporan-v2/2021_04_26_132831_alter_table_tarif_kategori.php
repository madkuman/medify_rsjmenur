<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableTarifKategori extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('keuangan')->table('tarif_kategori', function (Blueprint $table) {
            $table->integer('jenis_kegiatan_radiologi')->default(0);
            $table->integer('jenis_kegiatan_lab')->default(0);
            $table->integer('jenis_kegiatan_perinatologi')->default(0);
            $table->integer('jenis_kegiatan_gigi_mulut')->default(0);
            $table->integer('jenis_kegiatan_rehab_medik')->default(0);
            $table->integer('jenis_kegiatan_pelayanan_khusus')->default(0);
            $table->integer('jenis_kegiatan_kesehatan_jiwa')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('keuangan')->table('tarif_kategori', function (Blueprint $table) {
            $table->dropColumn('jenis_kegiatan_radiologi');
            $table->dropColumn('jenis_kegiatan_lab');
            $table->dropColumn('jenis_kegiatan_perinatologi');
            $table->dropColumn('jenis_kegiatan_gigi_mulut');
            $table->dropColumn('jenis_kegiatan_rehab_medik');
            $table->dropColumn('jenis_kegiatan_pelayanan_khusus');
            $table->dropColumn('jenis_kegiatan_kesehatan_jiwa');
        });
    }
}

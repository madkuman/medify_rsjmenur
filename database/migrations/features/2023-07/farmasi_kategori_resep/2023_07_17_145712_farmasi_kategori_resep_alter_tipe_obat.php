<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiKategoriResepAlterTipeObat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('tipe_obat', function (Blueprint $table) {
            $table->string('kategori_slug', 100)->nullable();
            $table->integer('beyond_use_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->table('tipe_obat', function (Blueprint $table) {
            $table->dropColumn([
                'kategori_slug',
                'beyond_use_date',
            ]);
        });
    }
}

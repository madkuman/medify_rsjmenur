<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiKategoriResepAlterAturanEmbalaseKategoriResep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('aturan_embalase', function (Blueprint $table) {
            $table->string('kategori_slug', 100)->nullable();
            $table->decimal('harga', 13, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->table('aturan_embalase', function (Blueprint $table) {
            $table->dropColumn('kategori_slug');
            $table->dropColumn('harga');
        });
    }
}

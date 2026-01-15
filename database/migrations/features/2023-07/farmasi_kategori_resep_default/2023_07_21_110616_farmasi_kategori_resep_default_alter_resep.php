<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiKategoriResepDefaultAlterResep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('resep', function (Blueprint $table) {
            $table->string('kategori_resep', 100)->nullable();
            $table->integer('resep_iter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->table('resep', function (Blueprint $table) {
            $table->dropColumn([
                'kategori_resep',
                'resep_iter',
            ]);
        });
    }
}

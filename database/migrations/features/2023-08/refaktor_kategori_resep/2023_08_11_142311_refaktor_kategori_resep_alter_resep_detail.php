<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefaktorKategoriResepAlterResepDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('resep_detail', function (Blueprint $table) {
            $table->integer('tipe_racikan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->table('resep_detail', function (Blueprint $table) {
            $table->dropColumn([
                'tipe_racikan_id',
            ]);
        });
    }
}

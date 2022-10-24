<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecalculateFarmasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('items', function (Blueprint $table) {
            $table->dateTime('tanggal_awal')->nullable();
            $table->integer('jumlah_awal')->default(0);
            $table->integer('jumlah_recalculate')->default(0);
            $table->integer('last_so_id')->nullable();
        });

        Schema::connection('farmasi')->table('stok_opname', function (Blueprint $table) {
            $table->integer('jenis')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

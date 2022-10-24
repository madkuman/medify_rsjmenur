<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPemesananDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gizi')->table('pemesanan_detail', function (Blueprint $table) {
            $table->integer('lokasi_id')->nullable();
            $table->integer('bangsal_id')->nullable();
            $table->integer('ruangan_id')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('kelas_id')->nullable();
            $table->integer('jenis_makanan_id')->nullable();
            $table->integer('diet_id')->nullable();
            $table->json('makanan_tambahan_ids')->nullable();
            $table->text('catatan')->nullable();
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

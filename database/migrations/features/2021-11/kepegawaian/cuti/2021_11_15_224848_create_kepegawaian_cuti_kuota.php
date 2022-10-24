<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKepegawaianCutiKuota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kepegawaian')->create('cuti_kuota', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('master_cuti_id');
            $table->integer('cuti_pengajuan_id');
            $table->dateTime('tanggal');
            $table->integer('kuota_perubahan');
            $table->integer('created_by');
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kepegawaian')->dropIfExists('cuti_kuota');
    }
}

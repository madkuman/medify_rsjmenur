<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKepegawaianCutiPengajuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kepegawaian')->create('cuti_pengajuan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jenis_cuti');
            $table->date('date_start');
            $table->date('date_end');
            $table->integer('alasan_cuti_id');
            $table->string('keterangan_alasan_cuti');
            $table->integer('bersedia_unpaid_leave');
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
        Schema::connection('kepegawaian')->dropIfExists('cuti_pengajuan');
    }
}

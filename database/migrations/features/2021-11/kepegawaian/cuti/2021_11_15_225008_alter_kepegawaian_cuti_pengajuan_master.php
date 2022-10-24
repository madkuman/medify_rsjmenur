<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterKepegawaianCutiPengajuanMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kepegawaian')->table('cuti_pengajuan', function (Blueprint $table) {
            $table->integer('master_cuti_id')->after('id');
            $table->dropColumn('jenis_cuti');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kepegawaian')->table('cuti_pengajuan', function (Blueprint $table) {
            $table->dropColumn('master_cuti_id')->after('id');
            $table->integer('jenis_cuti');
        });
    }
}

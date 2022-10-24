<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterKepegawaianCutiPengajuanResponse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kepegawaian')->table('cuti_pengajuan', function (Blueprint $table) {
            $table->string('status_pengajuan')->default('0')->after('bersedia_unpaid_leave');
            $table->dateTime('response_at')->nullable()->after('status_pengajuan');
            $table->integer('response_by')->nullable()->after('response_at');
            $table->string('response_keterangan')->nullable()->after('response_by');
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
            $table->dropColumn('status_pengajuan');
            $table->dropColumn('response_at');
            $table->dropColumn('response_by');
            $table->string('response_keterangan')->nullable()->after('response_by');
        });
    }
}

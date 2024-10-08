<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnJenisresepTableLogTaskJknId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('thirdp')->table('log_task_jkn_id', function (Blueprint $table) {
            $table->text('jenisresep')->nullable()->after('request');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('thirdp')->table('log_task_jkn_id', function (Blueprint $table) {
            $table->dropColumn('jenisresep');
        });
    }
}

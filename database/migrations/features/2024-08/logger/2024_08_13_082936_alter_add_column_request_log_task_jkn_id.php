<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAddColumnRequestLogTaskJknId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('thirdp')->table('log_task_jkn_id', function (Blueprint $table) {
            $table->text('request')->nullable();
            $table->string('status')->nullable();
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
            $table->dropColumn('request');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterIgdRuangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('igd')->table('ruangan', function (Blueprint $table) {
            $table->integer('sirs_covid_19_tt_id')->after('name')->nullable();
            $table->integer('sirs_covid_19_tt_id')->after('lokasi_id')->nullable();
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

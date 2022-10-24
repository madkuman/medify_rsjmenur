<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTempatTidur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rawatinap')->table('tempat_tidur', function (Blueprint $table) {
            $table->tinyInteger('is_hitung_statistik')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('rawatinap')->table('tempat_tidur', function (Blueprint $table) {
            $table->removeColumn('is_hitung_statistik');
        });
    }
}

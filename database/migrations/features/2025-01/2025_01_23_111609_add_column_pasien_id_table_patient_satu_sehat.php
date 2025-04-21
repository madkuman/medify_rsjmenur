<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPasienIdTablePatientSatuSehat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('satusehat')->table('patient', function (Blueprint $table) {
            $table->integer('pasien_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('satusehat')->table('patient', function (Blueprint $table) {
            $table->dropColumn('pasien_id');
        });
    }
}

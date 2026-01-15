<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDokterIdTablePractitionersSatuSehat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('satusehat')->table('practitioner', function (Blueprint $table) {
            $table->integer('dokter_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('satusehat')->table('practitioner', function (Blueprint $table) {
            $table->dropColumn('dokter_id');
        });
    }
}

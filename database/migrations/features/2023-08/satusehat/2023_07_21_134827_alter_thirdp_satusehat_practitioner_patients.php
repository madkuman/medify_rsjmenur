<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterThirdpSatusehatPractitionerPatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('satusehat')->table('practitioner', function (Blueprint $table) {
            $table->string('name')->after('his_number')->nullable();
        });

        Schema::connection('satusehat')->table('patient', function (Blueprint $table) {
            $table->string('name')->after('ihs_number')->nullable();
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
            $table->dropColumn('name');
        });

        Schema::connection('satusehat')->table('patient', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
}

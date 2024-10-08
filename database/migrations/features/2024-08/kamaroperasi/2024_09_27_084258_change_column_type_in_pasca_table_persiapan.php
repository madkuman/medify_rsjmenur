<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnTypeInPascaTablePersiapan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kamaroperasi')->table('pasca', function (Blueprint $table) {
            $table->longText('persiapan')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kamaroperasi')->table('pasca', function (Blueprint $table) {
            $table->string('persiapan', 256)->change(); // varchar(256)
        });
    }
}

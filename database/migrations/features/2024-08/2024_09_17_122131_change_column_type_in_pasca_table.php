<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnTypeInPascaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kamaroperasi')->table('pasca', function (Blueprint $table) {
            $table->longText('tindakan')->change();
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
            $table->string('tindakan', 256)->change(); // varchar(256)
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUbahPlafonByOnCKasusBpjsSepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('kasus', function (Blueprint $table) {
            $table->unsignedBigInteger('updated_plafon_by')->after('sep_id')->nullable();
            $table->timestamp('updated_plafon_at')->after('sep_id')->nullable();
            $table->bigInteger('plafon')->after('sep_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->table('kasus', function (Blueprint $table) {
            $table->dropColumn(['updated_plafon_by','updated_plafon_at', 'plafon']);
        });
    }
}

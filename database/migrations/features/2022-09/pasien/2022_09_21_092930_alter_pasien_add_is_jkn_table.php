<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPasienAddIsJknTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('patients')->table('pasien', function(Blueprint $table){
            $table->boolean('is_jkn')->default(0)->after('is_baru');
            $table->boolean('is_konfirmasi')->default(0)->after('is_jkn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('patients')->table('pasien', function(Blueprint $table){
            $table->dropColumn('is_jkn');
            $table->dropColumn('is_konfirmasi');
        });
    }
}

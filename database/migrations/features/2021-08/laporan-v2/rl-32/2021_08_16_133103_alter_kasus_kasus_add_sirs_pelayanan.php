<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterKasusKasusAddSirsPelayanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('kasus', function (Blueprint $table) {
            $table->integer('sirs_pelayanan_khusus_id')->nullable()->comment('relasi ke master_sirs_pelayanan_khusus, ini khusus untuk IGD aja');
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
            $table->dropColumn([
                'sirs_pelayanan_khusus_id'
            ]);
        });
    }
}

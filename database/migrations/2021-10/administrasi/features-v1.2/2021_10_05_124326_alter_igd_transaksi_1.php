<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterIgdTransaksi1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('igd')->table('transaksi', function (Blueprint $table) {
            $table->integer('asal_rujukan_id')->after('pasien_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('igd')->table('transaksi', function (Blueprint $table) {
            $table->dropColumn(['asal_rujukan_id']);
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePembayaranPerusahaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('patients')->table('pembayaran_perusahaan', function (Blueprint $table) {
            $table->integer('cara_bayar')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('patients')->table('pembayaran_perusahaan', function (Blueprint $table) {
            $table->dropColumn('cara_bayar');
        });
    }
}

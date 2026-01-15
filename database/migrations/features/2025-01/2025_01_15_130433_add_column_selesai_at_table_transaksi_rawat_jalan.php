<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSelesaiAtTableTransaksiRawatJalan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rawatjalan')->table('transaksi', function (Blueprint $table) {
            $table->timestamp('selesai_pelayanan_at')->nullable();
            $table->integer('selesai_pelayanan_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('rawatjalan')->table('transaksi', function (Blueprint $table) {
            $table->dropColumn('selesai_pelayanan_at');
            $table->dropColumn('selesai_pelayanan_by');
        });
    }
}

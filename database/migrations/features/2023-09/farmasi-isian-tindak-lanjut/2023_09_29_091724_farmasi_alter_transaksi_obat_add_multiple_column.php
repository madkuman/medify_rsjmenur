<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiAlterTransaksiObatAddMultipleColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('transaksi_obat', function (Blueprint $table) {
            $table->text('tindak_lanjut')->nullable();
            $table->dateTime('tindak_lanjut_created_at')->nullable();
            $table->unsignedBigInteger('tindak_lanjut_created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->table('transaksi_obat', function (Blueprint $table) {
            $table->dropColumn('tindak_lanjut');
            $table->dropColumn('tindak_lanjut_created_at');
            $table->dropColumn('tindak_lanjut_created_by');
        });
    }
}

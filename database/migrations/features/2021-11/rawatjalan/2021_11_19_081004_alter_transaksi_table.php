<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rawatjalan')->table('transaksi', function (Blueprint $table) {
            $table->text('payment_online_tipe')->nullable();
            $table->text('payment_online_nomor')->nullable();
            $table->integer('refund_status')->default(0);
            $table->integer('refund_status_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

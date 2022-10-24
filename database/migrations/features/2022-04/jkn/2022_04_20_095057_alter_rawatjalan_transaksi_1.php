<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRawatjalanTransaksi1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('rawatjalan')->hasColumn('transaksi', 'task_id_jkn')) {
            Schema::connection('rawatjalan')->table('transaksi', function ($table) {
                $table->integer('task_id_jkn')->default(0)->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::connection('rawatjalan')->hasColumn('transaksi', 'task_id_jkn')) {
            Schema::connection('rawatjalan')->table('transaksi', function ($table) {
                $table->dropColumn('task_id_jkn');
            });
        }
    }
}

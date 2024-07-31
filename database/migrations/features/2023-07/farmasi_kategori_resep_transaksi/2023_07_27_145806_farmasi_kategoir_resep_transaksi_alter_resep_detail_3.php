<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiKategoirResepTransaksiAlterResepDetail3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('resep_detail', function (Blueprint $table) {
            $table->string('tipe_racikan', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->table('resep_detail', function (Blueprint $table) {
            $table->dropColumn([
                'tipe_racikan',
            ]);
        });
    }
}

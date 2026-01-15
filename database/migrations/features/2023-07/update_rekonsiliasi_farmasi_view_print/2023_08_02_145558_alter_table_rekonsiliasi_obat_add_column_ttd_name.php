<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRekonsiliasiObatAddColumnTtdName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('rekonsiliasi_obat', function (Blueprint $table) {
            $table->string('ttd_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->table('rekonsiliasi_obat', function (Blueprint $table) {
            $table->dropColumn('ttd_name');
        });
    }
}

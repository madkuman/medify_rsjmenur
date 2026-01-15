<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDosisTableRacikanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('racikan_detail', function (Blueprint $table) {
            $table->integer('dosis')->nullable()->after('nama_obat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->table('racikan_detail', function (Blueprint $table) {
            $table->dropColumn('dosis');
        });
    }
}

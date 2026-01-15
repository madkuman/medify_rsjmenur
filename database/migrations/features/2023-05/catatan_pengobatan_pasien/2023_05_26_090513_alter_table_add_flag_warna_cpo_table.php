<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAddFlagWarnaCpoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('catatan_pengobatan_pasien', function (Blueprint $table) {
            $table->tinyInteger('cb_segera_diberikan')->nullable();
            $table->tinyInteger('cb_terlambat_diberikan')->nullable();
            $table->tinyInteger('cb_pemberian_bebas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->table('catatan_pengobatan_pasien', function (Blueprint $table) {
            $table->dropColumn([
                'cb_segera_diberikan', 'cb_terlambat_diberikan','cb_pemberian_bebas'
            ]);
        });
    }
}

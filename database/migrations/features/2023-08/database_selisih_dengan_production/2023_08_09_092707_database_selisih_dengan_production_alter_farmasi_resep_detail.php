<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatabaseSelisihDenganProductionAlterFarmasiResepDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('farmasi')->hasColumn('resep_detail', 'embalase')) {
            Schema::connection('farmasi')->table('resep_detail', function (Blueprint $table) {
                $table->integer('embalase')->nullable()->after('laba');
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
        if (Schema::connection('farmasi')->hasColumn('resep_detail', 'embalase')) {
            Schema::connection('farmasi')->table('resep_detail', function (Blueprint $table) {
                $table->dropColumn([
                    'embalase',
                ]);
            });
        }
    }
}

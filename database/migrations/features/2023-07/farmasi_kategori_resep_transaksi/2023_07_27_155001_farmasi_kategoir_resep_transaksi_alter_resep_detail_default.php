<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiKategoirResepTransaksiAlterResepDetailDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('resep_detail', function (Blueprint $table) {
            $table->string('default_petunjuk_minum', 100)->nullable();
            $table->string('default_catatan', 100)->nullable();
            $table->string('aturan_per_jam_1', 100)->nullable();
            $table->string('aturan_per_jam_2', 100)->nullable();
            $table->string('aturan_per_jam_3', 100)->nullable();
            $table->string('aturan_per_jam_4', 100)->nullable();
            $table->string('aturan_per_jam_5', 100)->nullable();
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
                'default_petunjuk_minum',
                'default_catatan',
                'aturan_per_jam_1',
                'aturan_per_jam_2',
                'aturan_per_jam_3',
                'aturan_per_jam_4',
                'aturan_per_jam_5',
            ]);
        });
    }
}

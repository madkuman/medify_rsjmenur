<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCatatanPengobatanPasien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('catatan_pengobatan_pasien', function (Blueprint $table) {
            $table->string('aturan_per_jam_1')->nullable();
            $table->string('aturan_per_jam_2')->nullable();
            $table->string('aturan_per_jam_3')->nullable();
            $table->string('aturan_per_jam_4')->nullable();
            $table->string('aturan_per_jam_5')->nullable();
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
            $table->dropColumn('aturan_per_jam_1');
            $table->dropColumn('aturan_per_jam_2');
            $table->dropColumn('aturan_per_jam_3');
            $table->dropColumn('aturan_per_jam_4');
            $table->dropColumn('aturan_per_jam_5');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAlatPulangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('alat_pulang', function (Blueprint $table) {
            $table->tinyInteger('discharge_mobilitas')->default(0);
            $table->tinyInteger('discharge_perawatan')->default(0);
            $table->tinyInteger('discharge_bantuan')->default(0);
            $table->tinyInteger('discharge_perawatan_diri')->default(0);
            $table->tinyInteger('discharge_obat')->default(0);
            $table->tinyInteger('discharge_diet')->default(0);
            $table->tinyInteger('discharge_luka')->default(0);
            $table->tinyInteger('discharge_latihan')->default(0);
            $table->tinyInteger('discharge_tenaga_khusus')->default(0);
            $table->tinyInteger('discharge_medis')->default(0);
            $table->tinyInteger('discharge_fisik')->default(0);
            $table->tinyInteger('discharge_umur')->default(0);
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

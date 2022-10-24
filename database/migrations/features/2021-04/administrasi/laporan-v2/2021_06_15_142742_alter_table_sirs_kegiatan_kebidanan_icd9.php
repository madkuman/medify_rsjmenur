<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSirsKegiatanKebidananIcd9 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('sirs_kegiatan_kebidanan_icd9', function (Blueprint $table) {
            $table->dropColumn('diagnosis_id');
            $table->integer('tindakan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('sirs_kegiatan_kebidanan_icd9', function (Blueprint $table) {
            $table->integer('diagnosis_id');
            $table->dropColumn('tindakan_id');
        });
    }
}

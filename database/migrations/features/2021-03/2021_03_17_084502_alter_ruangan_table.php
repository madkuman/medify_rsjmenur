<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rawatinap')->table('ruangan', function (Blueprint $table) {
            if (!Schema::connection('rawatinap')->hasColumn('ruangan', 'sirs_covid_19_tt_id')) {
                $table->integer('sirs_covid_19_tt_id')->after('kode_ruang')->nullable();
            }
            if (!Schema::connection('rawatinap')->hasColumn('ruangan', 'siranap_kode_ruang_kode')) {
                $table->string('siranap_kode_ruang_kode', 11)->after('sirs_covid_19_tt_id')->nullable();
            }
            if (!Schema::connection('rawatinap')->hasColumn('ruangan', 'siranap_tipe_pasien_kode')) {
                $table->string('siranap_tipe_pasien_kode', 11)->after('siranap_kode_ruang_kode')->nullable();
            }  
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

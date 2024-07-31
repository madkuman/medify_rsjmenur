<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KasusAsesmenAwalAlterTableAddColumnSkriningGiziAnak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('asesmen_awal_2', function (Blueprint $table) {
            $table->string('gizi_anak_tampak_kurus', 50)->nullable();
            $table->string('gizi_ada_turun_bb_1_bln', 50)->nullable();
            $table->string('gizi_ada_salah_satu_kondisi', 50)->nullable();
            $table->string('gizi_ada_penyakit_malnutrisi', 50)->nullable();
            $table->string('gizi_skor_akhir', 50)->nullable();
            $table->string('gizi_hasil_resiko', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->table('asesmen_awal_2', function (Blueprint $table) {
            $table->dropColumn([
	        'gizi_anak_tampak_kurus',
	        'gizi_ada_salah_satu_kondisi',
	        'gizi_ada_turun_bb_1_bln',
	        'gizi_ada_penyakit_malnutrisi',
	        'gizi_skor_akhir',
	        'gizi_hasil_resiko',
            ]);
        });
    }

}

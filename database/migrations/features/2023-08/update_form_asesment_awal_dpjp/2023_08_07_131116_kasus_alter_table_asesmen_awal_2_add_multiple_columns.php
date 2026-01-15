<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KasusAlterTableAsesmenAwal2AddMultipleColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('asesmen_awal_2', function (Blueprint $table) {
            $table->string('alergi_terhadap_obat')->nullable();
            $table->string('alergi_obat_ringan', 20)->nullable();
            $table->string('alergi_obat_sedang', 20)->nullable();
            $table->string('alergi_obat_berat', 20)->nullable();
            $table->string('reaksi_alergi_obat')->nullable();

            $table->string('alergi_terhadap_makanan')->nullable();
            $table->string('alergi_makanan_ringan', 20)->nullable();
            $table->string('alergi_makanan_sedang', 20)->nullable();
            $table->string('alergi_makanan_berat', 20)->nullable();
            $table->string('reaksi_alergi_makanan')->nullable();

            $table->unsignedBigInteger('rekonsiliasi_obat_id')->nullable();
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
            $table->dropColumn('alergi_terhadap_obat');
            $table->dropColumn('alergi_obat_ringan');
            $table->dropColumn('alergi_obat_sedang');
            $table->dropColumn('alergi_obat_berat');
            $table->dropColumn('reaksi_alergi_obat');
            
            $table->dropColumn('alergi_terhadap_makanan');
            $table->dropColumn('alergi_makanan_ringan');
            $table->dropColumn('alergi_makanan_sedang');
            $table->dropColumn('alergi_makanan_berat');
            $table->dropColumn('reaksi_alergi_makanan');
           
            $table->dropColumn('rekonsiliasi_obat_id');
        });
    }
}

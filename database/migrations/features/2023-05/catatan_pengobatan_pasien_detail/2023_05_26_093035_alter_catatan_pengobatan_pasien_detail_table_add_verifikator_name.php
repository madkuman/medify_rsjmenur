<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCatatanPengobatanPasienDetailTableAddVerifikatorName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('catatan_pengobatan_pasien_detail', function (Blueprint $table) {
            $table->string('verifikator_name_1')->nullable()->after('verified_by_2');
            $table->string('verifikator_name_2')->nullable()->after('verifikator_name_1');
            $table->text('path_ttd_verif_1')->nullable()->after('verifikator_name_2');
            $table->text('path_ttd_verif_2')->nullable()->after('path_ttd_verif_1');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->table('catatan_pengobatan_pasien_detail', function (Blueprint $table) {
            $table->dropColumn('verifikator_name_1');
            $table->dropColumn('verifikator_name_2');
            $table->dropColumn('path_ttd_verif_1');
            $table->dropColumn('path_ttd_verif_2');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahkolomhambatanpenerjemahpembelajaranAlterAsesmenPendidikanPasienDanKeluarga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('asesmen_pendidikan_pasien_dan_keluarga', function (Blueprint $table) {
            $table->string('hambatan', 255)->nullable();
            $table->string('penerjemah', 255)->nullable();
            $table->string('pembelajaran', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->table('asesmen_pendidikan_pasien_dan_keluarga', function (Blueprint $table) {
            $table->dropColumn([
                'hambatan', 'penerjemah', 'pembelajaran'
            ]);
        });
    }
}

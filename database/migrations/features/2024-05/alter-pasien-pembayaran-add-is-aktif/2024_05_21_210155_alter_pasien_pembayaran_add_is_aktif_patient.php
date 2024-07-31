<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPasienPembayaranAddIsAktifPatient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!(Schema::connection('patients')->hasColumn('pasien_pembayaran', 'is_aktif')  )) {
            Schema::connection('patients')->table('pasien_pembayaran', function (Blueprint $table) {
                $table->tinyInteger('is_aktif')->nullable()->default(1)->comment('Pengaturan ada di halaman profile pasien');
            });
        };
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

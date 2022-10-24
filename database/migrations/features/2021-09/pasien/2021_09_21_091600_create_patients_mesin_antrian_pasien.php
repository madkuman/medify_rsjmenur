<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsMesinAntrianPasien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('patients')->create('mesin_antrian_pasien', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_rm')->nullable();
            $table->integer('jenis_pasien')->nullable();
            $table->integer('loket_id')->nullable();
            $table->integer('poliklinik_id')->nullable();
            $table->integer('dokter_id')->nullable();
            $table->integer('id_jadwal')->nullable();
            $table->integer('transaksi_rawat_jalan_id')->nullable();
            $table->integer('jumlah_antrian')->nullable();
            $table->integer('konfirmasi_by')->nullable();
            $table->integer('cancel_by')->nullable();
            $table->string('nomor_sep')->nullable();
            $table->timestamps();
            $table->softDeletes();
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

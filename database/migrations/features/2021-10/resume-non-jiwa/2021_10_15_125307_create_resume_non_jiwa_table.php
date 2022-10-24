<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeNonJiwaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->create('resume_non_jiwa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kasus_id')->nullable();
            $table->text('diagnosa_masuk')->nullable();
            $table->text('diagnosa_utama')->nullable();
            $table->text('diagnosa_tambahan')->nullable();
            $table->text('jenis_tindakan')->nullable();
            $table->text('alasan_rawat')->nullable();
            $table->text('ringkasan')->nullable();
            $table->text('pemeriksaan_fisik')->nullable();
            $table->text('lab')->nullable();
            $table->text('terapi')->nullable();
            $table->text('hasil_konsul')->nullable();
            $table->text('perkembangan')->nullable();
            $table->text('keadaan_krs')->nullable();
            $table->text('waktu_kontrol')->nullable();
            $table->text('instruksi')->nullable();
            $table->integer('poli_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
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
        Schema::dropIfExists('resume_non_jiwa');
    }
}

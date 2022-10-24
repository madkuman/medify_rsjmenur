<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThirdpartyRujukBalik1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('thirdp')->create('rujuk_balik', function ($table) {
            $table->bigIncrements('id');
            $table->integer('pasien_id')->nullable();
            $table->string('no_sep',255);
            $table->string('no_kartu',255);
            $table->string('no_surat_rujuk_balik',255);
            $table->string('kode_program_prb',255)->nullable();
            $table->string('program_prb',255)->nullable();
            $table->string('kode_dpjp',255)->nullable();
            $table->string('dpjp',255)->nullable();
            $table->string('alamat_peserta',255)->nullable();
            $table->string('nama_peserta',255)->nullable();
            $table->string('email_peserta',255)->nullable();
            $table->text('keterangan')->nullable();
            $table->text('saran')->nullable();
            $table->datetime('tanggal_surat_rujuk_balik')->nullable();
            $table->longtext('plain_response')->nullable();
            $table->integer('status_vclaim')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::connection('thirdp')->create('rujuk_balik_detail', function ($table) {
            $table->bigIncrements('id');
            $table->integer('rujuk_balik_id');
            $table->string('kode_obat',255)->nullable();
            $table->string('nama_obat',255)->nullable();
            $table->string('signa1',255)->nullable();
            $table->string('signa2',255)->nullable();
            $table->integer('jumlah')->default(0);
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
        Schema::connection('thirdp')->dropIfExists('rujuk_balik');
        Schema::connection('thirdp')->dropIfExists('rujuk_balik_detail');
    }
}

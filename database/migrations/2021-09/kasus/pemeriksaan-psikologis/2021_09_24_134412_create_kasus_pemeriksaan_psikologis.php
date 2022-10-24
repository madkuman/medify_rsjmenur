<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKasusPemeriksaanPsikologis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('kasus')->hasTable('pemeriksaan_psikologis_anak')) {
            Schema::connection('kasus')->create('pemeriksaan_psikologis_anak', function ($table) {
                $table->bigIncrements('id');
                $table->integer('kasus_id')->nullable();
                $table->timestamp('tanggal_pemeriksaan')->nullable();
                $table->string('tujuan_tes')->nullable();
                $table->string('kerja_sama')->nullable();
                $table->string('tester_pasif_aktif')->nullable();
                $table->string('tester_tegang_tenang')->nullable();
                $table->string('tester_menjawab')->nullable();
                $table->string('sikap_keyakinan')->nullable();
                $table->string('sikap_penerimaan')->nullable();
                $table->string('kecepatan_kerja')->nullable();
                $table->string('kecekatan_kerja')->nullable();
                $table->string('pikiran_kerja')->nullable();
                $table->string('kerapian_kerja')->nullable();
                $table->string('perilaku')->nullable();
                $table->string('pengetahuan_kegagalan')->nullable();
                $table->string('usaha')->nullable();
                $table->string('kondisi_kegagalan')->nullable();
                $table->string('ketenangan_bicara')->nullable();
                $table->string('reaksi_bicara')->nullable();
                $table->string('kondisi_bicara')->nullable();
                $table->string('kejelasan_jawaban')->nullable();
                $table->string('kecakapan_bicara')->nullable();
                $table->string('kecepatan_reaksi')->nullable();
                $table->string('reaksi_kehati_hatian')->nullable();
                $table->string('reaksi_gerakan')->nullable();
                $table->string('keadaan_koordinasi_motorik')->nullable();
                $table->text('kesimpulan')->nullable();
                $table->text('saran')->nullable();
                $table->text('catatan')->nullable();
                $table->string('kategori')->nullable();
                $table->string('kecerdasan_umum')->nullable();
                $table->string('pengamatan_ruang')->nullable();
                $table->string('kemampuan_analisa')->nullable();
                $table->string('kemampuan_berpikir_analogi')->nullable();
                $table->string('emosi')->nullable();
                $table->string('kemampuan_sosial')->nullable();
                $table->string('kemampuan_adaptasi')->nullable();
                $table->string('motivasi_prestasi')->nullable();
                $table->timestamps();
                $table->integer('created_by');
                $table->integer('updated_by');
                $table->softDeletes();
                $table->integer('deleted_by')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->dropIfExists('pemeriksaan_psikologis_anak');
    }
}

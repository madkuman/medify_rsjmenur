<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterKasusPemeriksaanPsikologisAnak2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('kasus')->hasColumn('pemeriksaan_psikologis_anak','tanggal_pemeriksaan')) {
            Schema::connection('kasus')->table('pemeriksaan_psikologis_anak', function ($table) {
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
        if (Schema::connection('kasus')->hasTable('pemeriksaan_psikologis_anak')) {
            if (Schema::connection('kasus')->hasColumn('pemeriksaan_psikologis_anak','tanggal_pemeriksaan')) {
                Schema::connection('kasus')->table('pemeriksaan_psikologis_anak', function ($table) {
                    $table->dropColumn('tanggal_pemeriksaan');
                    $table->dropColumn('tujuan_tes');
                    $table->dropColumn('kerja_sama');
                    $table->dropColumn('tester_pasif_aktif');
                    $table->dropColumn('tester_tegang_tenang');
                    $table->dropColumn('tester_menjawab');
                    $table->dropColumn('sikap_keyakinan');
                    $table->dropColumn('sikap_penerimaan');
                    $table->dropColumn('kecepatan_kerja');
                    $table->dropColumn('kecekatan_kerja');
                    $table->dropColumn('pikiran_kerja');
                    $table->dropColumn('kerapian_kerja');
                    $table->dropColumn('perilaku');
                    $table->dropColumn('pengetahuan_kegagalan');
                    $table->dropColumn('usaha');
                    $table->dropColumn('kondisi_kegagalan');
                    $table->dropColumn('ketenangan_bicara');
                    $table->dropColumn('reaksi_bicara');
                    $table->dropColumn('kondisi_bicara');
                    $table->dropColumn('kejelasan_jawaban');
                    $table->dropColumn('kecakapan_bicara');
                    $table->dropColumn('kecepatan_reaksi');
                    $table->dropColumn('reaksi_kehati_hatian');
                    $table->dropColumn('reaksi_gerakan');
                    $table->dropColumn('keadaan_koordinasi_motorik');
                    $table->dropColumn('kesimpulan');
                    $table->dropColumn('saran');
                    $table->dropColumn('catatan');
                });
            }
        }
    }
}

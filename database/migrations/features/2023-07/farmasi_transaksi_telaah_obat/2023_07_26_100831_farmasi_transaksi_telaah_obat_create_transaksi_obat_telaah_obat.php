<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiTransaksiTelaahObatCreateTransaksiObatTelaahObat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->create('transaksi_obat_telaah_obat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaksi_id');
            $table->string('slug', 100);
            $table->string('nama_pasien', 100)->nullalbe();
            $table->string('no_rm', 100)->nullalbe();
            $table->string('tanggal_lahir', 100)->nullalbe();
            $table->string('nama_obat', 100)->nullalbe();
            $table->string('dosis_bentuk_kekuatan_sediaan', 100)->nullalbe();
            $table->string('jumlah', 100)->nullalbe();
            $table->string('rute_pemberian', 100)->nullalbe();
            $table->string('waktu_frekuensi_aturan_pakai', 100)->nullalbe();
            $table->timestamp('telaah_at')->nullable();
            $table->integer('telaah_by')->nullable();
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
        Schema::connection('farmasi')->dropIfExists('transaksi_obat_telaah_obat');
    }
}

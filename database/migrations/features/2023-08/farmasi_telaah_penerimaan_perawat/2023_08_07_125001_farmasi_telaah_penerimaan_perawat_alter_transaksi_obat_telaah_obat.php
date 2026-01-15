<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiTelaahPenerimaanPerawatAlterTransaksiObatTelaahObat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('transaksi_obat_telaah_obat', function (Blueprint $table) {
            $table->json('serah_terima_aturan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->table('transaksi_obat_telaah_obat', function (Blueprint $table) {
            $table->dropColumn([
                'serah_terima_aturan',
            ]);
        });
    }
}

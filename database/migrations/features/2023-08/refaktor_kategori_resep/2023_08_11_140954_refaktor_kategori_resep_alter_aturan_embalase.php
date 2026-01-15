<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefaktorKategoriResepAlterAturanEmbalase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('farmasi')->hasColumn('aturan_embalase', 'tipe_racikan_id')) {
            Schema::connection('farmasi')->table('aturan_embalase', function (Blueprint $table) {
                $table->integer('tipe_racikan_id')->nullable()->after('perusahaan_tipe_id');
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
        Schema::connection('farmasi')->table('aturan_embalase', function (Blueprint $table) {
            $table->dropColumn('tipe_racikan_id');
        });
    }
}

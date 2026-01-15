<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AturanEmbalasePerObatPerResep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('farmasi')->hasColumn('aturan_embalase', 'jenis_embalase')) {
            Schema::connection('farmasi')->table('aturan_embalase', function (Blueprint $table) {
                $table->string('jenis_embalase', 20)->nullable()->after('perusahaan_tipe_id');
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
            $table->dropColumn('jenis_embalase');
        });
    }
}

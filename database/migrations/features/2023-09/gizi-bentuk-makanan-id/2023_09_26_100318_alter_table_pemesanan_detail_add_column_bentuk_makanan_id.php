<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePemesananDetailAddColumnBentukMakananId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gizi')->table('pemesanan_detail', function (Blueprint $table) {
            $table->string('bentuk_makanan_id')->after('jenis_makanan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('gizi')->table('pemesanan_detail', function (Blueprint $table) {
            $table->dropColumn('bentuk_makanan_id');
        });
    }
}

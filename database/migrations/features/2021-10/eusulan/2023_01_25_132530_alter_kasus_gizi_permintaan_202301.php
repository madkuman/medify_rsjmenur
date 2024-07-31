<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterKasusGiziPermintaan202301 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('gizi_permintaan', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropColumn('order_id');
            $table->dropColumn('kasus_id');
        });

        Schema::connection('kasus')->table('gizi_permintaan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('waktu_makan_id')->after('id')->nullable();
            $table->integer('kasus_id')->after('waktu_makan_id')->nullable();
            $table->integer('bentuk_makanan_id')->after('kasus_id')->nullable();
            $table->integer('diet_id')->after('kasus_id')->nullable();
            $table->integer('lokasi_id')->after('diet_id')->nullable();
            $table->integer('bangsal_id')->after('lokasi_id')->nullable();
            $table->integer('batch')->after('bangsal_id')->nullable();
            $table->string('catatan', 255)->after('batch')->nullable();
            $table->tinyInteger('status')->after('catatan')->nullable()->comment('1 = aktif, 0 = nonaktif');
            $table->integer('created_by')->after('status')->nullable();
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

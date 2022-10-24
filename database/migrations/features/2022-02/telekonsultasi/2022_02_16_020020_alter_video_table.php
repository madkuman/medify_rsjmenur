<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rawatjalan')->table('video', function (Blueprint $table) {
            $table->integer('durasi')->nullable();
            $table->integer('durasi_tersedia')->nullable();
            $table->tinyInteger('is_ended')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('rawatjalan')->table('video', function (Blueprint $table) {
            $table->dropColumn([
                'durasi',
                'durasi_tersedia',
                'is_ended',
            ]);
        });
    }
}

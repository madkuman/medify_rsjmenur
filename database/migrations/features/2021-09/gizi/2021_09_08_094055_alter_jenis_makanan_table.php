<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterJenisMakananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gizi')->table('jenis_makanan', function (Blueprint $table) {
            $table->integer('utama')->nullable()->default(0)->comment('0 tambahan, 1 utama');
            $table->integer('diet')->nullable()->default(0)->comment('0 non diet, 1 diet');
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

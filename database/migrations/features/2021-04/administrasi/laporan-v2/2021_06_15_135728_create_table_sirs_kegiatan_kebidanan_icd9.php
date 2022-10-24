<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSirsKegiatanKebidananIcd9 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('sirs_kegiatan_kebidanan_icd9', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sirs_id');
            $table->integer('diagnosis_id');
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
        Schema::connection('mysql')->dropIfExists('sirs_kegiatan_kebidanan_icd9');
    }
}

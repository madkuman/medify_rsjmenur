<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiCreateTableItemJenisInteraksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->create('item_jenis_interaksi', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('item_template_id')->nullable();
            $table->unsignedBigInteger('master_jenis_interaksi_id')->nullable();
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->unsignedBigInteger('item_template_interaksi_id')->nullable();

            $table->string('keterangan')->nullable();
            $table->string('tipe')->nullable();

            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->dropIfExists('item_jenis_interaksi');
    }
}

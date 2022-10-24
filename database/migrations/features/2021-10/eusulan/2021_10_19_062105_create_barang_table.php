<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('eusulan')->create('barang', function (Blueprint $table) {
            $table->increments('id');
            $table->text('kode')->nullable();
            $table->text('nama')->nullable();
            $table->text('tipe')->nullable();
            $table->double('harga')->nullable();
            $table->text('satuan')->nullable();
            $table->integer('kelompok')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
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
        Schema::connection('eusulan')->dropIfExists('barang');
    }
}

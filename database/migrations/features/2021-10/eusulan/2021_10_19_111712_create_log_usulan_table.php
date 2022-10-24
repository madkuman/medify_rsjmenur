<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogUsulanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('eusulan')->create('log_usulan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usulan_id')->nullable();
            $table->integer('akun_rekening_id')->nullable();
            $table->integer('barang_id')->nullable();
            $table->integer('jumlah')->nullable();
            $table->double('harga')->nullable();
            $table->text('satuan')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('link')->nullable();
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
        Schema::connection('eusulan')->dropIfExists('log_usulan');
    }
}

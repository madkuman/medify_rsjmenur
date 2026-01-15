<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransaksiBmhpRadiologi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('radiology')->create('transaksi_bmhp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaksi_id');
            $table->integer('item_template_id')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index('transaksi_id');
            $table->index('item_template_id');
            $table->index(['transaksi_id', 'item_template_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('radiology')->dropIfExists('transaksi_bhmp');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThirdpSatusehatLogKasus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('satusehat')->create('log_encounter_condition', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('transaksi_rawat_jalan_id')->nullable();
            $table->bigInteger('kasus_id')->nullable();
            $table->text('response')->nullable();
            $table->smallInteger('status')->nullable()->comments('0 = sedang diproses, 1 = sukses, -1 gagal');
            $table->integer('created_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('satusehat')->dropIfExists('log_encounter_condition');
    }
}

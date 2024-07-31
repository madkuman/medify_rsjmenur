<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkoringPanssEc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->create('skoring_panss_ec', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('tanggal_pelaksanaan_skoring');
            $table->string('jam_pelaksanaan_skoring', 255)->nullable();
            $table->string('tempat_pelaksanaan_skoring', 255)->nullable();
            $table->double('gaduh_gelisah')->nullable();
            $table->double('permusuhan')->nullable();
            $table->double('ketegangan')->nullable();
            $table->double('ketidak_kooperatifan')->nullable();
            $table->double('pengendalian_impuls_yang_buruk')->nullable();
            $table->double('total')->nullable();
            $table->integer('kasus_id')->nullable();      
            $table->integer('created_by')->nullable();                     
            $table->integer('updated_by')->nullable();  
            $table->integer('deleted_by')->nullable();                
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->dropIfExists('skoring_panss_ec');
    }
}

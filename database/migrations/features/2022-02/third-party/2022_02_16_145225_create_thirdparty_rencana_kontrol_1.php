<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThirdpartyRencanaKontrol1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('thirdp')->hasTable('rencana_kontrol')) {
            Schema::connection('thirdp')->create('rencana_kontrol', function($table) {
                $table->bigIncrements('id');
                $table->string('no_sk')->nullable();
                $table->string('no_sep')->nullable();
                $table->string('no_kartu')->nullable();
                $table->integer('pasien_id')->index()->nullable();
                $table->string('nama_pasien')->nullable();
                $table->integer('kasus_id')->index()->nullable();
                $table->tinyInteger('jenis_kontrol')->nullable();
                $table->string('kode_poli')->nullable();
                $table->string('nama_poli')->nullable();
                $table->string('kode_dokter')->nullable();
                $table->string('nama_dokter')->nullable();
                $table->timestamp('tgl_rk')->nullable();
                $table->integer('created_by')->index()->nullable();
                $table->integer('updated_by')->index()->nullable();
                $table->timestamps();
                $table->integer('deleted_by')->index()->nullable();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('thirdp')->dropIfExists('rencana_kontrol');
    }
}

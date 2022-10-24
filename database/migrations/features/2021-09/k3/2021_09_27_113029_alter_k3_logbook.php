<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterK3Logbook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('k3')->table('logbook', function (Blueprint $table) {
            $table->integer('employees_id')->change()->nullable();
            $table->string('nama_pegawai')->after('employees_id')->nullable();
            $table->string('status_pegawai')->after('nama_pegawai')->nullable();
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

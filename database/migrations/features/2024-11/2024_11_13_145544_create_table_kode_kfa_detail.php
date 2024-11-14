<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKodeKfaDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->create('kode_kfa_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_kfa', 20)->nullable();
            $table->string('name')->nullable();
            $table->string('active')->nullable();
            $table->string('ucum')->nullable();
            $table->string('uom')->nullable();
            $table->string('nie')->nullable();
            $table->string('manufacturer')->nullable();
            $table->integer('generik')->nullable();
            $table->integer('fix_price')->nullable();
            $table->integer('het_price')->nullable();
            $table->string('nama_dagang')->nullable();
            $table->string('kode_kfa_92', 20)->nullable();
            $table->longText('value')->nullable();
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
        Schema::connection('farmasi')->dropIfExists('kode_kfa_detail');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTaskJknId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('thirdp')->create('log_task_jkn_id', function (Blueprint $table) {
            $table->id(); // Membuat kolom 'id' sebagai primary key dan auto increment
            $table->unsignedBigInteger('kodebooking')->nullable(); // Kolom 'transaksi_id'
            $table->integer('task_id')->nullable(); // Kolom 'task_id'
            $table->timestamp('waktu')->nullable(); // Kolom 'waktu' untuk mencatat waktu kirim task ID
            $table->text('response')->nullable(); // Kolom 'response' untuk menyimpan teks response dari BPJS
            $table->timestamps(); // Kolom 'created_at' dan 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('thirdp')->dropIfExists('log_task_jkn_id');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataArtisanCall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('mysql')->hasTable('data_artisan_call')) {
            Schema::connection('mysql')->create('data_artisan_call', function ($table) {
                $table->bigIncrements('id');
                $table->longText('param_request')->nullable();
                $table->string('command_artisan')->nullable();
                $table->longText('error')->nullable();
                $table->integer('status')->default(0)->comment('0 idle, 1 berhasil, -1 gagal, 2 in progres');
                $table->integer('created_by')->nullable();
                $table->integer('updated_by')->nullable();
                $table->integer('deleted_by')->nullable();
                $table->timestamp('proses_at')->nullable();
                $table->timestamp('done_at')->nullable();
                $table->integer('try_error')->default(0);
                $table->softDeletes();
                $table->timestamps();
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
        Schema::connection('mysql')->dropIfExists('data_artisan_call');
    }
}

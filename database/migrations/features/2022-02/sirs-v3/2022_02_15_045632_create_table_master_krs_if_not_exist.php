<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMasterKrsIfNotExist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('mysql')->hasTable('master_cara_pulang')) {
            Schema::connection('mysql')->create('master_cara_pulang', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nama')->nullable();
                $table->string('slug')->nullable();
                $table->integer('cara_pulang_inacbg_id')->nullable();
                $table->integer('created_by')->nullable();
                $table->integer('updated_by')->nullable();
                $table->integer('deleted_by')->nullable();
                $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
                $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
                $table->softDeletes();
            });

            Schema::connection('mysql')->create('master_cara_pulang_slug', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nama')->nullable();
                $table->string('slug')->nullable();
                $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
                $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
                $table->softDeletes();
            });
        }

        if (!Schema::connection('mysql')->hasTable('master_cara_pulang_inacbg')) {
            Schema::connection('mysql')->create('master_cara_pulang_inacbg', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nama')->nullable();
                $table->string('kode')->nullable();
                $table->integer('created_by')->nullable();
                $table->integer('updated_by')->nullable();
                $table->integer('deleted_by')->nullable();
                $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
                $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
                $table->softDeletes();
            });
        }

        if (!Schema::connection('mysql')->hasTable('master_status_pulang')) {
            Schema::connection('mysql')->create('master_status_pulang', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nama')->nullable();
                $table->string('slug')->nullable();
                $table->integer('created_by')->nullable();
                $table->integer('updated_by')->nullable();
                $table->integer('deleted_by')->nullable();
                $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
                $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
                $table->softDeletes();
            });
            Schema::connection('mysql')->create('master_status_pulang_slug', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nama')->nullable();
                $table->string('slug')->nullable();
                $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
                $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
                $table->softDeletes();
            });
        }

        Schema::connection('mysql')->table('master_cara_pulang', function (Blueprint $table) {
            $table->integer('sirs_status_keluar_id')->nullable()->after('cara_pulang_inacbg_id');
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

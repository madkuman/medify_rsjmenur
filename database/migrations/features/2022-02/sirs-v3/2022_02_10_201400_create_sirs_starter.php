<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSirsStarter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("CREATE DATABASE ".config('app.db_name')."_sirs");

        Schema::connection('sirs')->create('api_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 100)->nullable();
            $table->string('method', 50)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('connection', 100)->nullable()->comment('null jika tidak ada action untuk save ke db');
            $table->string('tabel', 100)->nullable()->comment('null jika tidak ada action untuk save ke db');
            $table->json('kolom_values')->nullable()->comment('null jika insert di semua kolom, json format jika save response ikut di tabel yang sudah ada');
            $table->json('kolom_comparing')->nullable()->comment('kolom untuk compare data saat auto sync');
            $table->smallInteger('auto_sync')->default(0)->comment('0 = manual sync data, 1 = auto sync data');
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::connection('sirs')->create('laporan_covid_19', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sirs_laporan_id')->nullable();
            $table->integer('kasus_id')->nullable();
            $table->integer('pasien_id')->nullable();
            $table->integer('lokasi_id')->nullable();
            $table->dateTime('sirs_krs_updated_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->index(['sirs_laporan_id']);
            $table->index(['kasus_id']);
            $table->index(['pasien_id']);
            $table->index(['lokasi_id']);
            $table->index(['created_by']);
        });

        Schema::connection('sirs')->create('log_laporan_covid_19', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipe')->nullable();
            $table->integer('kasus_id')->nullable();
            $table->integer('laporan_covid_19_id')->nullable();
            $table->integer('sirs_laporan_id')->nullable();
            $table->text('sirs_response')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->index(['kasus_id']);
            $table->index(['laporan_covid_19_id']);
            $table->index(['sirs_laporan_id']);
            $table->index(['created_by']);
        });

        Schema::connection('sirs')->create('master_asalpasien', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sirs_id')->nullable();
            $table->string('nama')->nullable();
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->index(['sirs_id']);
        });

        Schema::connection('sirs')->create('master_kelompokgejala', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sirs_id')->nullable();
            $table->string('nama')->nullable();
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->index(['sirs_id']);
        });

        Schema::connection('sirs')->create('master_statuspasien', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sirs_id')->nullable();
            $table->string('nama')->nullable();
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->index(['sirs_id']);
        });

        Schema::connection('sirs')->create('master_terapi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sirs_id')->nullable();
            $table->string('nama', 255)->nullable();
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->index(['sirs_id']);
        });

        Schema::connection('sirs')->create('master_kasuskematian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sirs_id')->nullable();
            $table->string('deskripsi', 255)->nullable();
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->index(['sirs_id']);
        });

        Schema::connection('sirs')->create('master_penyebabkematianlangsung', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sirs_id')->nullable();
            $table->text('description')->nullable();
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::connection('sirs')->create('master_alatoksigen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sirs_id')->nullable();
            $table->string('nama')->nullable();
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->index(['sirs_id']);
        });

        Schema::connection('sirs')->create('master_dosisvaksin', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sirs_id')->nullable();
            $table->string('nama')->nullable();
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->index(['sirs_id']);
        });

        Schema::connection('sirs')->create('master_jenisvaksin', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sirs_id')->nullable();
            $table->string('nama')->nullable();
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->index(['sirs_id']);
        });

        Schema::connection('mysql')->table('lokasi_departemen', function (Blueprint $table) {
            $table->integer('sirs_jenis_pasien_id')->nullable();

            $table->index(['sirs_jenis_pasien_id']);
        });

        Schema::connection('patients')->create('jenis_kewarganegaraan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')->nullable();
            $table->string('sirs_kewarganegaraan_id')->nullable();
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->index(['sirs_kewarganegaraan_id']);
        });

        Schema::connection('patients')->table('jenis_pekerjaan', function (Blueprint $table) {
            $table->integer('sirs_pekerjaan_id')->nullable()->after('nama');

            $table->index(['sirs_pekerjaan_id']);
        });

        Schema::connection('patients')->table('alamat_provinsi', function (Blueprint $table) {
            $table->integer('sirs_provinsi_id')->nullable()->after('id');

            $table->index(['sirs_provinsi_id']);
        });

        Schema::connection('patients')->table('alamat_kota', function (Blueprint $table) {
            $table->integer('sirs_kabkota_id')->nullable()->after('id');

            $table->index(['sirs_kabkota_id']);
        });

        Schema::connection('patients')->table('alamat_kecamatan', function (Blueprint $table) {
            $table->integer('sirs_kecamatan_id')->nullable()->after('id');

            $table->index(['sirs_kecamatan_id']);
        });

        Schema::connection('patients')->table('alamat_kelurahan', function (Blueprint $table) {
            $table->integer('sirs_kelurahan_id')->nullable()->after('id');

            $table->index(['sirs_kelurahan_id']);
        });

        \Artisan::call('db:seed', [
            '--class' => 'SIRSV3Seeder',
        ]);
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

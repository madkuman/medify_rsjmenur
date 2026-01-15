<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CasemixdownloadhasilfilterAlterDataArtisanCallHospital extends Migration
{
    protected $connection = 'mysql';
    protected $table = 'data_artisan_call';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('data_artisan_call', function (Blueprint $table) {
            if (!Schema::connection($this->connection)->hasColumn($this->table, 'end')) $table->integer('end')->nullable();
            if (!Schema::connection($this->connection)->hasColumn($this->table, 'progress')) $table->integer('progress')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('data_artisan_call', function (Blueprint $table) {
            $table->dropColumn([
                'end',
                'progress'
            ]);
        });
    }
}

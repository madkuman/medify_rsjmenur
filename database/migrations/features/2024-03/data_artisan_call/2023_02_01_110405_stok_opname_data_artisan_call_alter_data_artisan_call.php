<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StokOpnameDataArtisanCallAlterDataArtisanCall extends Migration
{
    protected $table = 'data_artisan_call';
    protected $connection = 'mysql';

    private function exist($column)
    {
        return Schema::connection($this->connection)->hasColumn($this->table, $column);
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('data_artisan_call', function (Blueprint $table) {
            if (!$this->exist('max_tries')) $table->integer('max_tries')->default(5)->after('try_error')->comment('Maksimal Percobaan');
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
            $table->dropColumn('max_tries');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StokOpnameDataArtisanCallAlterStokOpname extends Migration
{
    protected $table = 'stok_opname';
    protected $connection = 'farmasi';

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
        Schema::connection('farmasi')->table('stok_opname', function (Blueprint $table) {
            if (!$this->exist('data_artisan_call_id'))  $table->integer('data_artisan_call_id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->table('stok_opname', function (Blueprint $table) {
            $table->dropColumn('data_artisan_call_id');
        });
    }
}

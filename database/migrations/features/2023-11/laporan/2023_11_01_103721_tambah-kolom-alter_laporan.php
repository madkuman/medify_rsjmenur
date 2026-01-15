<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahKolomAlterLaporan extends Migration
{
    protected $connection = 'mysql';
    protected $table = 'laporan';

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
        Schema::connection($this->connection)->table($this->table, function (Blueprint $table) {
            if (!$this->exist('status')) {
                $table->tinyInteger('status')->default(0)->nullable();
            }

            if (!$this->exist('error')) {
                $table->json('error')->nullable();
            }
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

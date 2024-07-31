<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahKolomAlterAsesmenAwal2 extends Migration
{
    protected $connection = 'kasus';
    protected $table = 'asesmen_awal_2';

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
        Schema::connection($this->connection)->table($this->table, function (Blueprint $b) {
            if (!$this->exist('obat_nama')) $b->text('obat_nama')->nullable();
            if (!$this->exist('dosis')) $b->text('dosis')->nullable();
            if (!$this->exist('jumlah')) $b->text('jumlah')->nullable();
            if (!$this->exist('rute')) $b->text('rute')->nullable();
            if (!$this->exist('aturan_pakai')) $b->text('aturan_pakai')->nullable();
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

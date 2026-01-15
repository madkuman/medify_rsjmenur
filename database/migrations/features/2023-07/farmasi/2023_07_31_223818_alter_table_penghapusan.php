<?php

use App\Models\Farmasi\Penghapusan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePenghapusan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('farmasi')->table('penghapusan', function (Blueprint $table) {
            $table->integer('penghapusan_jenis_id')->nullable();
            $table->string('surat_perintah')->nullable();
            $table->string('no_pengeluaran')->nullable();
            $table->timestamp('tgl_pengeluaran')->nullable();
            $table->integer('penyedia_id')->nullable();
        });

        $query = "UPDATE penghapusan SET tgl_pengeluaran = created_at";
        $data = DB::connection('farmasi')->update($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('farmasi')->table('penghapusan', function (Blueprint $table) {
            $table->dropColumn([
	        'penghapusan_jenis_id', 'surat_perintah','no_pengeluaran','tgl_pengeluaran','penyedia_id'
            ]);
        });
    }
}

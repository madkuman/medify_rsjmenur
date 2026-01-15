<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTagihanDetailFlagIpwl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('tagihan_detail', function (Blueprint $table) {
            $table->timestamp('flag_ipwl_at')->nullable();
            $table->integer('flag_ipwl_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->table('tagihan_detail', function (Blueprint $table) {
            $table->dropColumn([
	        'flag_ipwl_at', 'flag_ipwl_by'
            ]);
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCpptAddColumnMarkedPrint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('kasus')->table('cppt', function (Blueprint $table) {
            $table->timestamp('marked_print_at')->nullable();
            $table->integer('marked_print_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('kasus')->table('cppt', function (Blueprint $table) {
            $table->dropColumn([
	        'marked_print_at', 'marked_print_by'
            ]);
        });
    }

}

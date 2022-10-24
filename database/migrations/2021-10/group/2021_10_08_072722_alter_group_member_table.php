<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGroupMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('group_member', function (Blueprint $table) {
            $table->integer('show')->default(1);
            $table->json('e_sakip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('group_member', function (Blueprint $table) {
            $table->dropColumn('show');
            $table->dropColumn('e_sakip');
        });
    }
}

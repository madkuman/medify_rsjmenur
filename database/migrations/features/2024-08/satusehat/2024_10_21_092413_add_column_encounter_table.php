<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnEncounterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('satusehat')->table('encounter', function (Blueprint $table) {
            $table->longText('uuid')->nullable()->after('id');
            $table->integer('kasus_id')->nullable()->after('uuid');
            $table->integer('hospital_lokasi_id')->nullable()->after('kasus_id');
            $table->text('request_param')->nullable()->after('hospital_lokasi_id');
            $table->smallInteger('status')->nullable()->after('request_param');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('satusehat')->table('encounter', function (Blueprint $table) {
            $table->dropColumn('uuid');
            $table->dropColumn('kasus_id');
            $table->dropColumn('hospital_lokasi_id');
            $table->dropColumn('request_param');
            $table->dropColumn('status');
        });
    }
}

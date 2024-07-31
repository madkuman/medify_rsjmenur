<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Hospital\SubSpesialisasi;

class AddSubSpesialisTableProfessionSpeciality extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $check = SubSpesialisasi::where('slug', 'magister-keperawatan')->first();
        if(!$check) {
            $sub = new SubSpesialisasi;
            $sub->name = 'Magister Keperawatan';
            $sub->slug  = 'magister-keperawatan';
            $sub->save();
        }
      
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

<?php

use App\Models\Farmasi\Kategori;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemsKategoriRadiologi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $check = Kategori::where('slug','radiologi')->first();
        if(empty($check)){
            $new_data = new Kategori();
            $new_data->nama = 'Radiologi';
            $new_data->slug = 'radiologi';
            $new_data->created_by = 3;
            $new_data->is_kandungan = 0;
            $new_data->save();
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

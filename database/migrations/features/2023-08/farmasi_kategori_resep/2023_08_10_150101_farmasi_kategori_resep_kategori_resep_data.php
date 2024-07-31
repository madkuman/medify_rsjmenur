<?php

use App\Models\Farmasi\KategoriResep;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FarmasiKategoriResepKategoriResepData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        return 1;
        $data = [];
        $data[] = [
            'slug' => 'racikan-kapsul',
            'nama' => 'Racikan Kapsul',
            'is_racikan_default' => 1,
            'beyond_use_date' => null,
        ];
        $data[] = [
            'slug' => 'racikan-puyer',
            'nama' => 'Racikan Puyer',
            'is_racikan_default' => 1,
            'beyond_use_date' => null,
        ];
        $data[] = [
            'slug' => 'racikan-salep',
            'nama' => 'Racikan Salep',
            'is_racikan_default' => 1,
            'beyond_use_date' => null,
        ];
        $data[] = [
            'slug' => 'resep-obat-jadi',
            'nama' => 'Resep Obat Jadi',
            'is_racikan_default' => 0,
            'beyond_use_date' => null,
        ];
        $data[] = [
            'slug' => 'dispensing-aseptik',
            'nama' => 'Dispensing Aseptik',
            'is_racikan_default' => 0,
            'beyond_use_date' => null,
        ];
        $data[] = [
            'slug' => 'obat-sediaan-tpn',
            'nama' => 'Obat Sediaan TPN',
            'is_racikan_default' => 0,
            'beyond_use_date' => null,
        ];
        $data[] = [
            'slug' => 'sirup-kering',
            'nama' => 'Sirup Kering',
            'is_racikan_default' => 1,
            'beyond_use_date' => null,
        ];
        
        KategoriResep::insert($data);
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

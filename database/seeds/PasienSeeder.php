<?php

use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    		factory(App\Models\Pasien\Pasien::class, 2000)->create();
    }
}

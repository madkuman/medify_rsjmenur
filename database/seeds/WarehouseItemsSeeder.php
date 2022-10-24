<?php

use Illuminate\Database\Seeder;

class WarehouseItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    		factory(App\Models\Warehouse\Items::class, 353)->create();
    }
}

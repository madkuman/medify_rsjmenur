<?php

use Illuminate\Database\Seeder;

class NutritionOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        	factory(App\Models\Nutrition\Order::class, 100)->create();
    }
}

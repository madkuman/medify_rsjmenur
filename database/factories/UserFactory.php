<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Pasien\Pasien::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'gender' => $faker->numberBetween($min = 1, $max = 2),
        'address' =>  $faker->address,
        'date_of_birth' => $faker->date,
        'place_of_birth' => $faker->city,
    ];
});

$factory->define(App\Models\Warehouse\Items::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'supplier' =>  $faker->numberBetween($min = 1, $max = 18),
        'type' => 1,
        'price' => $faker->randomNumber(2).'000',
        'slug' => $faker->slug,
        'created_by' => $faker->numberBetween($min = 1, $max = 2),

    ];
});

$factory->define(App\Models\Nutrition\Order::class, function (Faker $faker) {
    static $password;

    return [
        'nurse_name' => $faker->numberBetween($min = 3, $max = 4),
        'kelas' => $faker->numberBetween($min = 1, $max = 3),
        'bangsal' => $faker->numberBetween($min = 1, $max = 10),
        'ruangan' => $faker->numberBetween($min = 1, $max = 50),
        'class_recipe_id' => $faker->numberBetween($min = 30, $max = 41),
        'patient_name' =>$faker->name,
        'patient_age' => $faker->numberBetween($min = 1, $max = 50),
        'patient_diagnosis' => $faker->text,
        'patient_allergy' => $faker->text,
        'time' => 'pagi,siang,malam',
        'diet' => 'Biasa',
        'description' => $faker->text,
        'is_night' =>  1,
        'date_target' =>  '2018-03-17',
    ];
});
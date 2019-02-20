<?php

use Carbon\Carbon;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => 'Admin',
        'email' => 'admin@mail.com',
        'password' => bcrypt('admin'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\City::class, function (Faker\Generator $faker) {
    return ['name' => $faker->city];
});

$factory->define(App\Supplier::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'birth_year' => $faker->numberBetween(1930, date('Y')),
        'city_id' => factory(App\City::class)->create()->id,
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    $filepath = 'public/products_images';
    if(!File::exists($filepath)){
        File::makeDirectory($filepath);
    }

    return [
        'name' => $faker->word,
        'price' => $faker->numberBetween(10000, 100000),
        'status' => $faker->boolean(70),
        'image' => $faker->image($filepath, 400,300, 'fashion', false),
        'supplier_id' => factory(App\Supplier::class)->create()->id,
    ];
});

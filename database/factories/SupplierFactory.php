<?php

use Faker\Generator as Faker;

$factory->define(App\Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->jobTitle,
        'description' => $faker->unique()->text(50),
        'phone' => $faker->unique()->e164PhoneNumber,
        'address' => $faker->unique()->address,
    ];
});

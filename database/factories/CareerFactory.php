<?php

use Faker\Generator as Faker;

$factory->define(App\Career::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word(4),
        'code' => $faker->unique()->bothify('######'),
    ];
});

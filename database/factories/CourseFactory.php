<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word(4),
        'code' => strtoupper($faker->unique()->bothify('????####')),
    ];
});



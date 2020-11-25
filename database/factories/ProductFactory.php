<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'code' => $faker->unique()->ean13,
        'name' => $faker->unique()->sentence(2),
        'stockMinimum' => $faker->numberBetween(1, 10),
        'stockCurrent' => $faker->numberBetween(0, 20),
        'pricePurchase' => $faker->numberBetween(100, 20000),
        'priceSale' => $faker->numberBetween(100, 20000),
        'dateAcquisition' => $faker->dateTimeBetween('-2 years'),
        'expirate' => $faker->boolean(60),
        'dateExpiration' => $faker->dateTimeBetween('-2 weeks', '1 years'),
        'category_id' => \App\Category::all()->random()->id,
        'supplier_id' => \App\Supplier::all()->random()->id,
        'warehouse_id' => \App\Warehouse::all()->random()->id,
    ];
});

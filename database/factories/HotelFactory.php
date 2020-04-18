<?php

use Faker\Generator as Faker;

$factory->define(App\Hotel::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'accommodations' => $faker->sentences(mt_rand(3, 10))
    ];
});

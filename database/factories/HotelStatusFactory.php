<?php

use Faker\Generator as Faker;

$factory->define(App\HotelStatus::class, function (Faker $faker) {
    return [
        'name' => $faker->words(1, true),
    ];
});

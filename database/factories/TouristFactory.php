<?php

use Faker\Generator as Faker;

$factory->define(App\Tourist::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'description' => $faker->text
    ];
});

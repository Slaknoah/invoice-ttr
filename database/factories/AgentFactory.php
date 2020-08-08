<?php

use Faker\Generator as Faker;

/** @var TYPE_NAME $factory */
$factory->define(App\Agent::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'company' => $faker->company,
    ];
});

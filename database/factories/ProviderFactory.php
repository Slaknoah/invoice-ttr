<?php

use Faker\Generator as Faker;

$factory->define(App\Provider::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'from_email' => $faker->companyEmail,
        'to_email' => $faker->companyEmail,
        'to_phone' => $faker->phoneNumber,
    ];
});

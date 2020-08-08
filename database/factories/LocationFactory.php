<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(App\Location::class, function (Faker $faker) {
    $country = $faker->country;
    $country_code = strtoupper( substr( $country, 0, 3 ) );
    return [
        'name'          => $country,
        'code'          => $country_code,
        'latitude'      => $faker->latitude,
        'longitude'     => $faker->longitude
    ];
});

<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $COUNTRY    = 'country';
        $CITY       = 'city';
        $faker      = Faker::create();

        $countries = factory(\App\Location::class, 10)->create(['type' => $COUNTRY]);

        foreach ( $countries as $country ) {
            $cities = factory(\App\Location::class, rand(20, 40))->create([
                'type'      => $CITY,
                'parent_id' => $country->id
            ]);

            foreach ( $cities as $city ) {
                $city_name = $faker->city;
                $city_short_name = substr($city_name, 0, 3);

                $city->name         = $city_name;
                $city->short_name   = $city_short_name;
                $city->save();
            }
        }
    }
}

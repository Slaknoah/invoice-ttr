<?php

use Illuminate\Database\Seeder;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hotels = factory(\App\Hotel::class, 200)->create();

        $countries = \App\Location::where('type', 'country')->get();

        foreach ($hotels as $hotel) {
            $country = $countries[ rand(0, ( count($countries) - 1) ) ];
            $cities = $country->children;

            $hotel->city()->associate( $cities[ rand(0, ( count($cities) - 1) ) ] )->save();
            $hotel->country()->associate( $country )->save();
        }
    }
}

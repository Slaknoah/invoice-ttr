<?php

use App\Hotel;
use Illuminate\Database\Seeder;

class TouristsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hotels = Hotel::all('id');

        $tourists = factory(App\Tourist::class, 100)->create();

        foreach ($tourists as $tourist) {
            $tourist->hotels()->attach([
                $hotels[rand(0, 4)]->id,
                $hotels[rand(0, 4)]->id,
            ]);
        }
    }
}

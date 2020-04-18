<?php

use Illuminate\Database\Seeder;

class HotelStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\HotelStatus::class, 4)->create();
    }
}

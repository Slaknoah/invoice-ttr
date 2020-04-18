<?php

use Illuminate\Database\Seeder;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Provider::class, 2)->create(['send_to_email' => 1]);
        factory(\App\Provider::class, 2)->create(['send_to_phone' => 1]);
        factory(\App\Provider::class, 1)->create(['send_to_phone' => 1, 'send_to_email' => 1]);
    }
}

<?php

use Illuminate\Database\Seeder;

class AgentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Agent::class, 3)->create(['approved' => 1]);
        factory(\App\Agent::class, 3)->create();
    }
}

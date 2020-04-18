<?php

use App\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::where('name', 'administrator')->first();
        $manager_role = Role::where('name', 'manager')->first();
        $agent_role = Role::where('name', 'agent')->first();
        $user_role = Role::where('name', 'user')->first();

        factory(App\User::class)->create([
            'email' => 'admin@email.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => date("Y-m-d g:i:s"),
        ])->role()->associate($admin_role)->save();

        factory(App\User::class)->create([
            'email' => 'manager@email.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => date("Y-m-d g:i:s"),
        ])->role()->associate($manager_role)->save();

        for ($i=0; $i < 5; $i++) { 
            factory(App\User::class)->create([
                'email' => "agent$i@email.com",
                'password' => bcrypt('123456')
            ])->role()->associate($agent_role)->save();
        }

        for ($i=0; $i < 5; $i++) {
            factory(App\User::class)->create([
                'email' => "user$i@email.com",
                'password' => bcrypt('123456')
            ])->role()->associate($user_role)->save();
        }
    }
}

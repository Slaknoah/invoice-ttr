<?php

use App\Permission;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Permissions
        $view_stats = Permission::create([
            'name' => 'view-stats',
            'description' => 'View app statistics'
        ]);

        $crud_users = Permission::create([
            'name' => 'crud-users',
            'description' => 'Add, edit, delete and perform other actions on users.'
        ]);
        
        $crud_hotels = Permission::create([
            'name' => 'crud-hotels',
            'description' => 'Add, delete or edit hotel information.'
        ]);
        
        $crud_services = Permission::create([
            'name' => 'crud-services',
            'description' => 'Add, delete or edit service information.'
        ]);
        
        $crud_tourists = Permission::create([
            'name' => 'crud-tourists',
            'description' => 'Add, delete or edit tourists information.'
        ]);

        $manage_roles_and_permissions = Permission::create([
            'name' => 'manage-roles-and-permissions',
            'description' => 'Set roles and remove roles from users, set and remove permissions for roles.'
        ]);

        factory(App\Role::class)->create([
            'name' => 'administrator',
        ]);

        factory(App\Role::class)->create([
            'name' => 'manager',
        ])->permissions()->attach([
            $crud_hotels->id,
            $crud_services->id,
            $crud_tourists->id
        ]);

        factory(App\Role::class)->create([
            'name' => 'agent',
        ]);

        factory(App\Role::class)->create([
            'name' => 'user',
        ]);
    }
}

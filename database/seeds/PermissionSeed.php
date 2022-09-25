<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name'=>'create_users']);
        Permission::create(['name'=>'update_users']);
        Permission::create(['name'=>'show_users']);
        Permission::create(['name'=>'delete_users']);
        Permission::create(['name'=>'create_roles']);
        Permission::create(['name'=>'update_roles']);
        Permission::create(['name'=>'show_roles']);
        Permission::create(['name'=>'delete_roles']);
        Permission::create(['name'=>'show_permissions']);
        Permission::create(['name'=>'assign_permissions']);
        Permission::create(['name'=>'create_pages']);
        Permission::create(['name'=>'update_pages']);
        Permission::create(['name'=>'show_pages']);
        Permission::create(['name'=>'delete_pages']);
        Permission::create(['name'=>'show_settings']);
        Permission::create(['name'=>'save_settings']);
        Permission::create(['name'=>'show_contacts']);
        Permission::create(['name'=>'show_statistics_users']);
        Permission::create(['name'=>'show_statistics_pages']);
        Permission::create(['name'=>'show_statistics_translates']);
        Permission::create(['name'=>'show_translates']);

    }
}

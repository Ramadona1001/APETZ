<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name','Admin')->first();
        foreach (Permission::all() as $permission) {
            $role->givePermissionTo($permission->name);
        }
    }
}

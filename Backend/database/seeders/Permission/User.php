<?php

namespace Database\Seeders\Permission;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public static function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'get-users']);
        Permission::create(['name' => 'delete-user']);
        Permission::create(['name' => 'show-user']);

    }
}

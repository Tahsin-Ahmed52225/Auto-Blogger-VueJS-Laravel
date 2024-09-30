<?php

namespace Database\Seeders\Permission;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class Post extends Seeder
{
    /**
     * Run the database seeds.
     */
    public static function run(): void
    {
        Permission::create(['name' => 'create-post']);
        Permission::create(['name' => 'edit-post']);
        Permission::create(['name' => 'get-posts']);
        Permission::create(['name' => 'delete-post']);
        Permission::create(['name' => 'show-post']);
    }
}

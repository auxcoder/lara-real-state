<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // properties
            'view properties',
            'create properties',
            'edit properties',
            'delete properties',
            'view developer properties',
            'create developer properties',
            'edit developer properties',
            'delete developer properties',
            // communities
            'view communities',
            'create communities',
            'edit communities',
            'delete communities',
            // blogs
            'view blogs',
            'create blogs',
            'edit blogs',
            'delete blogs',
            // developers
            'view developers',
            'create developers',
            'edit developers',
            'delete developers',
            // agentes
            'view agents',
            'create agents',
            'edit agents',
            'delete agents',
            // users
            'view users',
            'create users',
            'edit users',
            'delete users',
            // roles
            'manage roles',
            // permissions
            'manage permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $editor = Role::firstOrCreate(['name' => 'editor']);
        $editor->givePermissionTo([
            'view properties',
            'create properties',
            'edit properties',
            'view developer properties',
            'create developer properties',
            'edit developer properties',
            'view communities',
            'edit communities',
            'view blogs',
            'create blogs',
            'edit blogs',
            'view developers',
            'view agents',
        ]);

        $viewer = Role::firstOrCreate(['name' => 'viewer']);
        $viewer->givePermissionTo([
            'view properties',
            'view developer properties',
            'view communities',
            'view blogs',
            'view developers',
            'view agents',
        ]);
    }
}

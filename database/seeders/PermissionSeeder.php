<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'create roles',
            'read roles',
            'update roles',
            'delete roles',
            'create permissions',
            'read permissions',
            'update permissions',
            'delete permissions',
            'create users',
            'read users',
            'update users',
            'delete users',
            'create attendences',
            'read attendences',
            'update attendences',
            'delete attendences',
            'create leaves',
            'read leaves',
            'update leaves',
            'delete leaves',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'super admin']);
        $role->givePermissionTo($permissions);

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo(['read users']);

        $role = Role::create(['name' => 'employee']);
        $role->givePermissionTo(['read attendences', 'read leaves']);

        $role = Role::create(['name' => 'hr']);
        $role->givePermissionTo(['read attendences', 'read leaves']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo($permissions);

    }
}

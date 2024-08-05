<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;


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

        $role = Role::create(['name' => 'Super Admin']);
        $role->givePermissionTo($permissions);


        $role2 = Role::create(['name' => 'User']);
        $role->givePermissionTo(['read users']);

        $role3 = Role::create(['name' => 'Employee']);
        $role->givePermissionTo(['read attendences', 'read leaves']);

        $role4 = Role::create(['name' => 'HR']);
        $role->givePermissionTo(['read attendences', 'read leaves']);

        $role5 = Role::create(['name' => 'Admin']);
        $role->givePermissionTo($permissions);

        $user = \App\Models\User::factory()->create([
            'name' => 'Super-Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole($role);

    }
}

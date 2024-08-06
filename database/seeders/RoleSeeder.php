<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
                $role = Role::create(['name' => 'Super Admin'])->givePermissionTo(Permission::all());
                $user = User::first();
                $user->assignRole($role);

                Role::create(['name' => 'Admin']);
                Role::create(['name' => 'Employee']);
                Role::create(['name' => 'HR']);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error("##### RolesSeeder->run  #####". $e->getMessage());
        }

    }
}

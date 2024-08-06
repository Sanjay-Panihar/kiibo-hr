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

        #admin
        Permission::firstOrCreate(['group' => 'admin', 'name' => 'View All Admin', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'admin', 'name' => 'Create Admin', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'admin', 'name' => 'View Admin Details', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'admin', 'name' => 'Edit Admin', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'admin', 'name' => 'Delete Admin', 'status' => 1, 'guard_name' => 'web']);

        #User
        Permission::firstOrCreate(['group' => 'user', 'name' => 'View All Users', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'user', 'name' => 'Create User', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'user', 'name' => 'View User Details', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'user', 'name' => 'Edit User', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'user', 'name' => 'Delete User', 'status' => 1, 'guard_name' => 'web']);

        #Role
        Permission::firstOrCreate(['group' => 'role', 'name' => 'View All Roles', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'role', 'name' => 'Create Role', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'role', 'name' => 'View Role Details', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'role', 'name' => 'Edit Role', 'status' => 1, 'guard_name' => 'web']);

        #Permission
        Permission::firstOrCreate(['group' => 'permission', 'name' => 'View All Permissions', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'permission', 'name' => 'Create Permissions', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'permission', 'name' => 'View Permissions Details', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'permission', 'name' => 'Edit Permissions', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'permission', 'name' => 'Delete Permissions', 'status' => 1, 'guard_name' => 'web']);

        #Event
        Permission::firstOrCreate(['group' => 'event', 'name' => 'View All Events', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'event', 'name' => 'Create Event', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'event', 'name' => 'View Event Details', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'event', 'name' => 'Edit Event', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'event', 'name' => 'Delete Event', 'status' => 1, 'guard_name' => 'web']);

        #Attendence
        Permission::firstOrCreate(['group' => 'attendence', 'name' => 'View All Attendences', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'attendence', 'name' => 'Create Attendence', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'attendence', 'name' => 'View Attendence Details', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'attendence', 'name' => 'Edit Attendence', 'status' => 1, 'guard_name' => 'web']);

        #Leave
        Permission::firstOrCreate(['group' => 'leave', 'name' => 'View All Leaves', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'leave', 'name' => 'Create Leave', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'leave', 'name' => 'View Leave Details', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'leave', 'name' => 'Edit Leave', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'leave', 'name' => 'Delete Leave', 'status' => 1, 'guard_name' => 'web']);

        #Timesheet
        Permission::firstOrCreate(['group' => 'timesheet', 'name' => 'View All Timesheets', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'timesheet', 'name' => 'Create Timesheet', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'timesheet', 'name' => 'View Timesheet Details', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'timesheet', 'name' => 'Edit Timesheet', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'timesheet', 'name' => 'Delete Timesheet', 'status' => 1, 'guard_name' => 'web']);

        #Employee Report
        Permission::firstOrCreate(['group' => 'employee report', 'name' => 'View All Employee Reports', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'employee report', 'name' => 'Create Employee Report', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'employee report', 'name' => 'View Employee Report Details', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'employee report', 'name' => 'Edit Employee Report', 'status' => 1, 'guard_name' => 'web']);

        #Policy
        Permission::firstOrCreate(['group' => 'policy', 'name' => 'View All Policies', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'policy', 'name' => 'Create Policy', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'policy', 'name' => 'View Policy Details', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'policy', 'name' => 'Edit Policy', 'status' => 1, 'guard_name' => 'web']);

        #Settings
        Permission::firstOrCreate(['group' => 'settings', 'name' => 'Change Password', 'status' => 1, 'guard_name' => 'web']);
        Permission::firstOrCreate(['group' => 'settings', 'name' => 'Delete Account', 'status' => 1, 'guard_name' => 'web']);

    }
}


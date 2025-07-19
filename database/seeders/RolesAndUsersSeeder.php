<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Clear cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define all permissions
        $models = ['Employee', 'Visitor', 'User', 'Asset', 'Payment', 'IncomingLetter', 'OutgoingLetter', 'Attendance', 'Settings', 'Help', 'MemoTracker', 'Report']; 
        $actions = ['create', 'view', 'edit', 'delete', 'status'];

        // $permissions = [
        //     'createVisitor',
        //     'viewVisitors',
        //     'editVisitor',
        //     'deleteVisitor',
        //     'manageUsers',
        //     'viewEmployee',
        //     'createEmployee',
        //     'updateEmployee',
        //     'deleteEmployee',
        //     'assignRoles',
        //     'viewReports',
        //     'exportData',
        // ];

        // Create permissions
        foreach ($models as $model) {
            foreach ($actions as $action){
                $name = "$action$model";
                Permission::firstOrCreate(['name' => $name]);
            }
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        $guestRole = Role::firstOrCreate(['name' => 'Guest']);

        // Assign permissions to roles
        $adminRole->syncPermissions(Permission::all());

        $staffRole->syncPermissions([
            'createVisitor',
            'viewVisitor',
            'editVisitor',
        ]);

        $guestRole->syncPermissions([
            'viewVisitor',
            'viewEmployee'
        ]);

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@adam1.com'],
            [
                'contact' => '0540000008',
                'title'=>'MIS Officer',
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
            ]
        );
        $admin->assignRole($adminRole);

        // Create staff user
        $staff = User::firstOrCreate(
            ['email' => 'staff@adam1.com'],
            [
                'contact' => '0540000007',
                'title'=>'MIS Officer',
                'name' => 'Staff User',
                'password' => Hash::make('password123'),
            ]
        );
        $staff->assignRole($staffRole);

        // Create guest user
        $guest = User::firstOrCreate(
            ['email' => 'guest@adam1.com'],
            [
                'contact' => '0540000006',
                'title'=>'MIS Officer',
                'name' => 'Guest User',
                'password' => Hash::make('password123'),
            ]
        );
        $guest->assignRole($guestRole);
    }
}

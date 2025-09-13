<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class RolesAndUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define modules and actions
        $modules = [
            'Employee', 'Visitor', 'User', 'Asset', 'Payment',
            'IncomingLetter', 'OutgoingLetter', 'Attendance',
            'Settings', 'Help', 'Memo', 'Report'
        ];

        $actions = ['create', 'view', 'edit', 'delete', 'status'];

        // Create permissions
        foreach ($modules as $module) {
            foreach ($actions as $action) {
                $permission = "{$action}{$module}";
                Permission::firstOrCreate(['name' => $permission]);
            }
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        $guestRole = Role::firstOrCreate(['name' => 'Guest']);

        // Assign all permissions to Admin
        $adminRole->syncPermissions(Permission::all());

    //     // Assign limited permissions to Staff
    //     $staffPermissions = [
    //         'createVisitor',
    //         'viewVisitor',
    //         'editVisitor',
    //         'deleteVisitor',
    //    ];
    //     $staffRole->syncPermissions($staffPermissions);

        // // Assign very limited permissions to Guest
        // $guestPermissions = [
        //     'viewVisitor',
        //     'viewEmployee',
        // ];
        // $guestRole->syncPermissions($guestPermissions);

        // Create Admin user
        $admin = User::firstOrCreate(
            ['email' => 'phpwebartisan@gmail.com'],
            [
                'name' => 'Web Artisan',
                'title' => 'Developer',
                'contact' => '0540000008',
                'password' => Hash::make('php@ADAM'),
            ]
        );
        $admin->assignRole($adminRole);

    //     // Create Staff user
    //     $staff = User::firstOrCreate(
    //         ['email' => 'staff@adam1.com'],
    //         [
    //             'name' => 'Staff User',
    //             'title' => 'MIS Officer',
    //             'contact' => '0540000007',
    //             'password' => Hash::make('password123'),
    //         ]
    //     );
    //     $staff->assignRole($staffRole);

    //     // Create Guest user
    //     $guest = User::firstOrCreate(
    //         ['email' => 'guest@adam1.com'],
    //         [
    //             'name' => 'Guest User',
    //             'title' => 'MIS Officer',
    //             'contact' => '0540000006',
    //             'password' => Hash::make('password123'),
    //         ]
    //     );
    //     $guest->assignRole($guestRole);
     }
}

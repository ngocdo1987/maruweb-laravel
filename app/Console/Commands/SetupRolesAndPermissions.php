<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;

class SetupRolesAndPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maruweb:setup-roles-and-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[MARUWEB] Setup roles and permissions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 1) Setup roles: dev > super admin > user admin > content admin
        $roles = ['dev', 'super admin', 'content admin', 'user admin'];
        foreach ($roles as $role) {
            $getRole = Role::where('name', $role)
                            ->where('guard_name', 'admin')
                            ->first();
            if (!isset($getRole->name)) {
                $getRole = Role::create([
                    'name' => $role,
                    'guard_name' => 'admin'
                ]);
            }

            echo "Get ".$role." role or create ".$role." role successfully!\n";
        }
        
        // 2) Setup permissions: dashboard , user, admin, common setting
        // Assign roles for permissions
        $dashboardPer = Permission::create([
            'name' => 'manage dashboard',
            'guard_name' => 'admin'
        ]);
        $dashboardPer->assignRole(['dev', 'super admin', 'user admin']);
        echo "Assign dashboard permission to roles: dev + super admin + user admin successfully!\n";

        $userPer = Permission::create([
            'name' => 'manage users',
            'guard_name' => 'admin'
        ]);
        $userPer->assignRole(['dev', 'super admin', 'user admin']);
        echo "Assign user permission to roles: dev + super admin + user admin successfully!\n";

        $adminPer = Permission::create([
            'name' => 'manage admins',
            'guard_name' => 'admin'
        ]);
        $adminPer->assignRole(['dev', 'super admin']);
        echo "Assign admin permission to roles: dev + super admin successfully!\n";
        
        $commonSettingPer = Permission::create([
            'name' => 'manage common settings',
            'guard_name' => 'admin'
        ]);
        $commonSettingPer->assignRole(['dev', 'super admin']);
        echo "Assign common setting permission to roles: dev + super admin successfully!\n";
        
        // 3) Assign roles for list admins
        $dev = Admin::where('email', 'dev@maruweb.vn')->first();
        $dev->assignRole('dev');
        echo "Assign dev@maruweb.vn to dev role successfully!\n";

        $admin = Admin::where('email', 'admin@maruweb.vn')->first();
        $admin->assignRole('super admin');
        echo "Assign admin@maruweb.vn to super admin role successfully!\n";

        $contentAdmin = Admin::where('email', 'contentadmin@maruweb.vn')->first();
        $contentAdmin->assignRole('content admin');
        echo "Assign contentadmin@maruweb.vn to content admin role successfully!\n";

        $userAdmin = Admin::where('email', 'useradmin@maruweb.vn')->first();
        $userAdmin->assignRole('user admin');
        echo "Assign useradmin@maruweb.vn to user admin role successfully!\n";

        echo "Setup roles and permissions successfully!\n";
    }
}

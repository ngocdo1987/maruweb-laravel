<?php

namespace App\Console\Commands\Maruweb;

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
        $this->info('THIS IS LARAVEL SETUP ROLES AND PERMISSIONS TOOL!');
        $adminGuardName = config('constants.setup.admin_guard_name');

        // 1) Setup roles: dev > super admin > user admin > content admin
        $roles = config('constants.setup.roles');
        foreach ($roles as $role) {
            $getRole = Role::where('name', $role)
                            ->where('guard_name', $adminGuardName)
                            ->first();
            if (!isset($getRole->name)) {
                $getRole = Role::create([
                    'name' => $role,
                    'guard_name' => $adminGuardName
                ]);
            }

            echo "Get ".$role." role or create ".$role." role successfully!\n";
        }
        
        // 2) Setup permissions: dashboard , user, admin, common setting
        // Assign roles for permissions
        $permissionsAssignRoles = config('constants.setup.permissions_assign_roles');
        foreach ($permissionsAssignRoles as $perName => $roles) {
            $per = Permission::create([
                'name' => $perName,
                'guard_name' => $adminGuardName
            ]);
            $per->assignRole($roles);
            echo "Assign ".$perName." permission to roles: ".implode(" + ", $roles)." successfully!\n";
        }
        
        // 3) Assign roles for list admins
        $assignRolesToAdmins = config('constants.setup.assign_roles_to_admins');
        foreach ($assignRolesToAdmins as $email => $role) {
            $admin = Admin::where('email', $email)->first();
            $admin->assignRole($role);
            echo "Assign ".$email." to ".$role." role successfully!\n";
        }

        echo "Setup roles and permissions successfully!\n";
    }
}

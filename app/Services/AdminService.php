<?php
namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class AdminService extends AbstractEloquentService
{
    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    public function searchAdvanced($request, $paginate = 0)
    {
        $data = $request->all();

        $admins = DB::table('admins')
                    ->join('model_has_roles', 'admins.id', '=', 'model_has_roles.model_id')
                    ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                    ->where(function ($query) use ($data) {
                        //
                        $query->where('model_has_roles.model_type', 'App\Models\Admin');

                        // Remove current logged in admin
                        //$query->where('admins.id', '!=', auth()->user()->id);

                        // name
                        if (isset($data['search_name']) && $data['search_name'] != '') {
                            $query->where('admins.name', 'like', '%'.$data['search_name'].'%');
                        }

                        // email
                        if (isset($data['search_email']) && $data['search_email'] != '') {
                            $query->where('admins.email', 'like', '%'.$data['search_email'].'%');
                        }

                        // role
                        if (isset($data['search_role']) && $data['search_role'] != '') {
                            $query->where('roles.name', $data['search_role']);
                        }

                        // last login date
                        if (isset($data['search_from_last_login_date']) && $data['search_from_last_login_date'] != '') {
                            $query->whereDate('admins.last_login_date', '>=', $data['search_from_last_login_date']);
                        }

                        if (isset($data['search_to_last_login_date']) && $data['search_to_last_login_date'] != '') {
                            $query->whereDate('admins.last_login_date', '<=', $data['search_to_last_login_date']);
                        }
                    })
                    ->select('admins.id', 'admins.name', 'admins.email', 'admins.last_login_date', 'admins.created_at', 'admins.updated_at', 'roles.name as role_name', 'roles.created_at as role_created_at', 'roles.updated_at as role_updated_at')
                    ->orderBy('admins.id', 'DESC');
        
        if ($paginate == 1) {
            return $admins->latest()->paginate(config('constants.admin.per_page'));
        } else {
            return $admins->get();
        }
    }

    // Store new admin
    public function storeAdmin($request)
    {
        $data = $request->all();

        $data['password'] = bcrypt($data['password']);

        $admin = Admin::create($data);
        $admin->assignRole($data['role']);
        
        return $admin->id;
    }

    // Update existing user
    public function updateAdmin($request)
    {
        $data = $request->all();

        if (trim($data['password']) == '') {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        $admin = Admin::findOrFail($data['id']);
        $admin->syncRoles([$data['role']]);
        $admin->update($data);

        return $admin->id;
    }

    // Get current admin not me!
    public function getAdminNotMe($id)
    {
        return Admin::where('id', $id)
                    ->where('id', '!=', auth()->user()->id)
                    ->firstOrFail();
    }
}

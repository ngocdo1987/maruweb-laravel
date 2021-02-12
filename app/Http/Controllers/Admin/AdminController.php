<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;

use App\Services\AdminService;
use App\Models\Admin;
use App\Services\ActivityLogService;

class AdminController extends Controller
{
    protected $service;
    protected $activityLogService;

    public function __construct(AdminService $service, ActivityLogService $activityLogService)
    {
        $this->service = $service;
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admins = $this->service->searchAdvanced($request, 1);
        $roleConfig = config('constants.admin.role');

        return view('admin.admins.index', compact('admins', 'roleConfig'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roleConfig = config('constants.admin.role');

        return view('admin.admins.create', compact('roleConfig'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        try {
            $id = $this->service->storeAdmin($request);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die('');
            return redirect()->back()->withErrors(['message' => $e->getMessage()])->withInput();
        }

        $url = route('admin.admins.edit', $id).'?page='.request()->page;
        return redirect($url)->with('success', __('Save successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = $admin->getRoleNames();
        $currentRole = isset($roles[0]) ? $roles[0] : '';
        $roleConfig = config('constants.admin.role');
        list($menuConfig, $menuLinkConfig, $actionTypeConfig) = $this->prepareData();
        list($activityLogs, $count) = $this->activityLogService->getByAdminId($id, 0);

        return view('admin.admins.show', compact('admin', 'currentRole', 'roleConfig', 'menuConfig', 'menuLinkConfig', 'actionTypeConfig', 'activityLogs', 'count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = $admin->getRoleNames();
        $currentRole = isset($roles[0]) ? $roles[0] : '';
        $roleConfig = config('constants.admin.role');
        list($menuConfig, $menuLinkConfig, $actionTypeConfig) = $this->prepareData();
        list($activityLogs, $count) = $this->activityLogService->getByAdminId($id, 0);

        return view('admin.admins.edit', compact('admin', 'currentRole', 'roleConfig', 'menuConfig', 'menuLinkConfig', 'actionTypeConfig', 'activityLogs', 'count'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, $id)
    {
        try {
            $this->service->updateAdmin($request);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()])->withInput();
        }

        $url = route('admin.admins.edit', $id).'?page='.request()->page;
        return redirect($url)->with('success', __('Save successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->activityLogs()->delete();
        Admin::destroy($id);

        $url = route('admin.admins.index').'?page='.request()->page;
        return redirect($url)->with('success', __('Deleted successfully'));
    }

    public function loadMoreActivityLogs(Request $request)
    {
        $offset = $request->offset;
        $id = $request->id;

        list($activityLogs, $count) = $this->activityLogService->getByAdminId($id, $offset);
        list($menuConfig, $menuLinkConfig, $actionTypeConfig) = $this->prepareData();

        return view('admin.admins.load_more_activity_logs', compact('activityLogs', 'menuConfig', 'menuLinkConfig', 'actionTypeConfig'));
    }

    private function prepareData()
    {
        return [
            config('constants.activity_log.menu'),
            config('constants.activity_log.menu_link'),
            config('constants.activity_log.action_type')
        ];
    }
}

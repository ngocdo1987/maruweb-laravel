<?php

namespace App\Observers;

use App\Models\Admin;
use App\Services\ActivityLogService;

class AdminObserver
{
    protected $activityLogService;
    protected $prefix = 'KAN';

    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }
    
    /**
     * Handle the admin "created" event.
     *
     * @param  \App\Admin  $admin
     * @return void
     */
    public function created(Admin $admin)
    {
        $this->activityLogService->storeActivityLog($admin, $this->prefix, 'Add');
    }

    /**
     * Handle the admin "updated" event.
     *
     * @param  \App\Admin  $admin
     * @return void
     */
    public function updated(Admin $admin)
    {
        $this->activityLogService->storeActivityLog($admin, $this->prefix, 'Update');
    }

    /**
     * Handle the admin "deleted" event.
     *
     * @param  \App\Admin  $admin
     * @return void
     */
    public function deleted(Admin $admin)
    {
        $this->activityLogService->storeActivityLog($admin, $this->prefix, 'Delete');
    }

    /**
     * Handle the admin "restored" event.
     *
     * @param  \App\Admin  $admin
     * @return void
     */
    public function restored(Admin $admin)
    {
        //
    }

    /**
     * Handle the admin "force deleted" event.
     *
     * @param  \App\Admin  $admin
     * @return void
     */
    public function forceDeleted(Admin $admin)
    {
        //
    }
}

<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\ActivityLog;

class CategoryObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        if (auth()->guard('admin')->check() && isset(auth()->guard('admin')->user()->id) && isset($category->id)) {
            ActivityLog::create([
                'admin_id' => auth()->guard('admin')->user()->id,
                'menu' => array_search('DUM', config('constants.activity_log.menu')),
                'action_type' => array_search('Add', config('constants.activity_log.action_type')),
                'ref_id' => $category->id
            ]);
        }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        if (auth()->guard('admin')->check() && isset(auth()->guard('admin')->user()->id) && isset($category->id)) {
            ActivityLog::create([
                'admin_id' => auth()->guard('admin')->user()->id,
                'menu' => array_search('DUM', config('constants.activity_log.menu')),
                'action_type' => array_search('Update', config('constants.activity_log.action_type')),
                'ref_id' => $category->id
            ]);
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        if (auth()->guard('admin')->check() && isset(auth()->guard('admin')->user()->id) && isset($category->id)) {
            ActivityLog::create([
                'admin_id' => auth()->guard('admin')->user()->id,
                'menu' => array_search('DUM', config('constants.activity_log.menu')),
                'action_type' => array_search('Delete', config('constants.activity_log.action_type')),
                'ref_id' => $category->id
            ]);
        }
        
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}

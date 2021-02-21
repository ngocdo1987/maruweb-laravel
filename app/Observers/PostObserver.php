<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\ActivityLog;

class PostObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        if (auth()->guard('admin')->check() && isset(auth()->guard('admin')->user()->id) && isset($post->id)) {
            ActivityLog::create([
                'admin_id' => auth()->guard('admin')->user()->id,
                'menu' => array_search('DUM', config('constants.activity_log.menu')),
                'action_type' => array_search('Add', config('constants.activity_log.action_type')),
                'ref_id' => $post->id
            ]);
        }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        if (auth()->guard('admin')->check() && isset(auth()->guard('admin')->user()->id) && isset($post->id)) {
            ActivityLog::create([
                'admin_id' => auth()->guard('admin')->user()->id,
                'menu' => array_search('DUM', config('constants.activity_log.menu')),
                'action_type' => array_search('Update', config('constants.activity_log.action_type')),
                'ref_id' => $post->id
            ]);
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        if (auth()->guard('admin')->check() && isset(auth()->guard('admin')->user()->id) && isset($post->id)) {
            ActivityLog::create([
                'admin_id' => auth()->guard('admin')->user()->id,
                'menu' => array_search('DUM', config('constants.activity_log.menu')),
                'action_type' => array_search('Delete', config('constants.activity_log.action_type')),
                'ref_id' => $post->id
            ]);
        }
        
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Observer
use App\Observers\AdminObserver;
use App\Models\Admin;
use App\Observers\UserObserver;
use App\Models\User;

class ActivityLogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Admin::observe(AdminObserver::class);
        User::observe(UserObserver::class);
    }
}

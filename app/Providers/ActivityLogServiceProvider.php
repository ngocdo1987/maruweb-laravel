<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Observer
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
        User::observe(UserObserver::class);
    }
}

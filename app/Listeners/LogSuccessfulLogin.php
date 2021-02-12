<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Log;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        $isAdmin = false;
        $isUser = false;

        $checkAdmin = Admin::where('id', $user->id)
                            ->where('name', $user->name)
                            ->where('email', $user->email)
                            ->first();

        $checkUser = User::where('id', $user->id)
                            ->where('name', $user->name)
                            ->where('email', $user->email)
                            ->first();

        if (isset($checkAdmin->id)) {
            $isAdmin = true;
        }

        if (isset($checkUser->id)) {
            $isUser = true;
        }

        // Disable all observers
        if ($isAdmin == true) {
            Admin::withoutEvents(function () use ($user) {
                $user->update([
                    'last_login_date' => date('Y-m-d H:i:s')
                ]);
            });
        }
        
        if ($isUser == true) {
            User::withoutEvents(function () use ($user) {
                $user->update([
                    'last_login_date' => date('Y-m-d H:i:s')
                ]);
            });
        }

        // Save login activity log only for admin
        if (auth()->guard('admin')->check() && $isAdmin == true) {
            
            ActivityLog::create([
                'admin_id' => $user->id,
                'menu' => -1,
                'action_type' => array_search('Login', config('constants.activity_log.action_type')),
                'ref_id' => 0
            ]);
            
        }
    }
}

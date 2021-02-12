<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

use App\Notifications\AdminPasswordReset;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_login_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'admins';

    // Send reset password email
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminPasswordReset($this->name, $this->email, $token));
    }

    public function activityLogs()
    {
        return $this->hasMany('App\Models\ActivityLog', 'admin_id', 'id');
    }
}

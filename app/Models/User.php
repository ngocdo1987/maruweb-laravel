<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

use App\Notifications\PasswordReset;
use App\Notifications\PasswordResetCorp;
use App\Services\ReplyMailService;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'fname', 'lname', 'fname_kana', 'lname_kana',
        'home_postcode', 'home_prefecture', 'home_city', 'home_address',
        'gender', 'birthday',
        'company_name', 'company_name_kana', 'company_postcode', 'company_prefecture', 'company_city', 'company_address', 'company_email', 'company_tel', 'company_fax', 'choose_mailing_address',
        'corporation_name', 'corporation_name_kana', 'head_office_postcode', 'head_office_prefecture', 'head_office_city', 'head_office_address',
        'association_notification_representative_fname', 'association_notification_representative_lname', 'association_notification_representative_fname_kana', 'association_notification_representative_lname_kana', 'department', 'representative_email',
        'association_notification_representative_2nd_fname', 'association_notification_representative_2nd_lname', 'association_notification_representative_2nd_fname_kana', 'association_notification_representative_2nd_lname_kana', 'department_2nd', 'representative_email_2nd',
        'refining_building_rating', 'client',
        'mailing_postcode', 'mailing_prefecture', 'mailing_city', 'mailing_address',
        'receive_name', 'contact_fname', 'contact_lname', 'contact_fname_kana', 'contact_lname_kana', 'contact_department', 'contact_email',
        'payment_method', 'email_magazine', 'email_delivery_address', 'tel', 'fax',
        'corporate_url', 'industry', 'number_of_applications',
        'admin_note', 'user_type', 'status', 'display_on_list',
        'settlement_confirmation_date', 'last_deposit_report_date', 'last_login_date'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';

    // Send reset password email
    public function sendPasswordResetNotification($token)
    {
        if ($this->user_type == 2) {
            $name = $this->fname.' '.$this->lname;
            // Send email
            $this->notify(new PasswordReset($name, $this->email, $token));

            // Reply mail log
            ReplyMailService::saveLog('password_reset', [
                'name' => $this->name,
                'route_password_reset' => url('password/reset', $token).'?email='.$this->email
            ], $this->id);
        } else {
            if( $this->corporation_name != NULL ){
                $name = $this->corporation_name;
                // Send email
                $this->notify(new PasswordResetCorp($name, $this->email, $token));

                // Reply mail log
                ReplyMailService::saveLog('password_reset_corp', [
                    'name' => $name,
                    'route_password_reset' => url('password/reset', $token).'?email='.$this->email
                ], $this->id);
            } else {
                $name = $this->name;
                // Send email
                $this->notify(new PasswordReset($name, $this->email, $token));

                // Reply mail log
                ReplyMailService::saveLog('password_reset', [
                    'name' => $this->name,
                    'route_password_reset' => url('password/reset', $token).'?email='.$this->email
                ], $this->id);
            }

        }
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment', 'user_id', 'id')->orderBy('created_at', 'DESC');
    }

    public function replyMails()
    {
        return $this->hasMany('App\Models\ReplyMail', 'user_id', 'id');
    }

    public function events()
    {
        return $this->hasMany('App\Models\Event', 'user_id', 'id');
    }

    public function contacts()
    {
        return $this->hasMany('App\Models\Contact', 'user_id', 'id');
    }

    // For PayJP
    public function payjpCustomers()
    {
        return $this->hasMany('App\Models\PayJpCustomer', 'user_id', 'id');
    }

    public function payjpCards()
    {
        return $this->hasMany('App\Models\PayJpCard', 'user_id', 'id');
    }

    public function payjpSubscriptions()
    {
        return $this->hasMany('App\Models\PayJpSubscription', 'user_id', 'id');
    }
}

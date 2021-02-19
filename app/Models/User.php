<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'business_name', 'country_code', 'mobile', 'email', 'password', 'fail_attempt', 'addr_1', 'addr_2', 'city', 'country', 'zip', 'periodic_billing', 'communication_preference', 'notification_preference', 'timezone', 'status', 'admin_note'
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

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * Set the user's notification_preference.
     *
     * @param  array  $value
     * @return void
     */
    public function setNotificationPreferenceAttribute($value)
    {
        $this->attributes['notification_preference'] = implode(',', $value);
    }

    /**
     * Get the user's notification_preference.
     *
     * @param  string  $value
     * @return array
     */
    public function getNotificationPreferenceAttribute($value)
    {
        return explode(',', $value);
    }
}

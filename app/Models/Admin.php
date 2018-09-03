<?php

namespace App\Models;

use App\Notifications\Admin\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

     /**
     * The roles that belong to the admin.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function checkRole($cat, $slug)
    {
        return $this->roles()->whereCategory($cat)->whereSlug($slug)->first();
    }
}

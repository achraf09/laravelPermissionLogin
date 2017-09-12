<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;
use Spatie\Permission\Traits\HasRoles;
class SuperAdmin extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guard= 'superadmin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function setPasswordAttribute($password)
    {
    $this->attributes['password'] = bcrypt($password);
  }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SuperAdminResetPasswordNotification($token));
    }
}

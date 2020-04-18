<?php

namespace App;

use App\Notifications\VerifyApiEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role_id', 'password', 'phone', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo('App\Role');
    }

    /**
     * Check if user has Role
     */
     public function hasRole($role) {
        return $role == $this->role->name;
    }

    /**
     * Check if user has access to permissions
     */
     public function hasAccess(array $permissions) {
        if($this->role->hasAccess($permissions)) {
            return true;
        }
        return false;
     }

    public function sendApiEmailVerificationNotification()
    {
        $this->notify(new VerifyApiEmail);
    }
    
    public function permissions() {
        return $this->role->permissions();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    public function permissions() {
        return $this->belongsToMany('App\Permission');
    }

    public function users() {
        return $this->hasMany('App\User');
    }

    /**
    * Check if Role has access to permission or permissions
    */
    public function hasAccess($permissions) {
        foreach ($permissions as $permission) {
            if($this->hasPermission($permission)){
                return true;
            }
        }
        return false;
    }

    protected function hasPermission(string $permission) {
        return null !== $this->permissions()->where('name', $permission)->first();
    }
}

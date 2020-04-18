<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Authorize all action for admin
     * @param User $user
     * @param $ability
     * @return bool
     */
     public function before(User $user, $ability)
     {
         if ($user->hasRole('administrator') && $ability !== 'delete') {
             return true;
         }
     }
     
     public function list(User $user) {
        return $user->hasAccess(['crud-users']);
     }

     public function create(User $user) {
        return $user->hasAccess(['crud-users']);
     }

     public function update(User $request_user, User $model_user) {
         return $request_user->hasAccess(['crud-users']) || ($request_user->id === $model_user->id);
     }  
     
     public function delete(User $request_user, User $model_user) {
         if ($model_user->hasRole('administrator'))
             return false;

         return $request_user->hasAccess(['crud-users']) || $request_user->hasRole('administrator') ||$request_user->id == $model_user->id;
     }
}

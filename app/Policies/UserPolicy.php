<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //调用时，第一个参数不用传，系统会自动注入
    public function update(User $currentUser,User $user){
        return $currentUser->id === $user->id;
    }
}

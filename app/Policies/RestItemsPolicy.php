<?php

namespace App\Policies;

use App\Models\restItem;
use App\Models\User;

use Illuminate\Auth\Access\Response;

class RestItemsPolicy
{
    /**
     * Create a new policy instance.
     */
    public function modifyuser(User $user,restItem $restItems) : Response
    {    
        return $user->id == $restItems->users_id?
        Response::allow():
        Response::deny('you dont own of this post ');
    }
}

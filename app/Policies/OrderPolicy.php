<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
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

    public function store($user){
        return $user->type == User::TYPE_CLIENT;
    }

    public function index($user){
        return $user->type == User::TYPE_CLIENT;
    }

    public function show($user){
        return $user->type == User::TYPE_CLIENT;
    }
}

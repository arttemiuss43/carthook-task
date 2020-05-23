<?php

namespace App\Http\Controllers;

use App\User;

class UsersController extends ApiController
{
    public function index()
    {
        return $this->ok([
            'users' => User::latest()->get()
        ]);
    }

    public function show(User $user)
    {
        return $this->ok(compact('user'));
    }
}

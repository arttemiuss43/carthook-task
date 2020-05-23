<?php

namespace App\Http\Controllers;

use App\Api\UsersRequest;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return [
            'users' => User::latest()->get()
        ];
    }

    public function show(User $user)
    {
        return compact('user');
    }
}

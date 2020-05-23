<?php

namespace App\Http\Controllers;

use App\User;

class PostsController extends Controller
{
    public function index(User $user)
    {
        return [
            'posts' => $user->posts
        ];
    }
}

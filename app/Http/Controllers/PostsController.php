<?php

namespace App\Http\Controllers;

use App\User;

class PostsController extends ApiController
{
    public function index(User $user)
    {
        return $this->ok([
            'posts' => $user->posts
        ]);
    }
}

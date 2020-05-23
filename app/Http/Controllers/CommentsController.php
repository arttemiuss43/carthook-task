<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;

class CommentsController extends ApiController
{
    public function index(User $user, Post $post)
    {
        return $this->ok([
            'comments' => $post->comments
        ]);
    }
}

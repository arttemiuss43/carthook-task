<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;

class CommentsController extends Controller
{
    public function index(User $user, Post $post)
    {
        return [
            'comments' => $post->comments
        ];
    }
}

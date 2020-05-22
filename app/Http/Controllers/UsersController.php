<?php

namespace App\Http\Controllers;

use App\Api\UsersRequest;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(UsersRequest $users)
    {
        return $users->all();
    }
}

<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->group(function () {
    Route::get('/', [UsersController::class, 'index']);

    Route::prefix('{user}')->group(function () {
        Route::get('/', [UsersController::class, 'show']);

        Route::prefix('posts')->group(function () {
            Route::get('/', [PostsController::class, 'index']);
            Route::get('{post:id}/comments', [CommentsController::class, 'index']);
        });
    });
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Post;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'post_id' => Post::inRandomOrder()->first()->id,
        'remote_id' => rand(1, 10000),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'body' => $faker->paragraph,
    ];
});

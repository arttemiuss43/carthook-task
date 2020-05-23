<?php

namespace Tests\Unit;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Http::fake([
            '/users' => Http::response([
                [
                    'id' => 1,
                    'name' => 'John Doe',
                    'username' => 'johndoe',
                    'email' => 'johndoe@gmail.com',
                    'phone' => '123456789',
                    'website' => 'http://example.com'
                ]
            ]),
            '/posts' => Http::response([
                [
                    'id' => 1,
                    'userId' => 1,
                    'title' => 'Some title',
                    'body' => 'Some body'
                ]
            ]),
            '/comments' => Http::response([
                [
                    'id' => 1,
                    'postId' => 1,
                    'name' => 'Jane Doe',
                    'email' => 'jane@gmail.com',
                    'body' => 'Some comment'
                ]
            ])
        ]);
    }

    /** @test */
    public function it_updates_users_in_local_database()
    {
        $this->artisan('api:sync');

        $this->assertCount(1, User::all());
        $this->assertEquals('John Doe', User::first()->name);

        // The same users should be updated rather than be created twice
        $this->artisan('api:sync');

        $this->assertCount(1, User::all());
    }

    /** @test */
    public function it_updates_posts_in_local_database()
    {
        $this->artisan('api:sync');

        $user = User::first();

        $this->assertCount(1, $user->posts);
        $this->assertEquals('Some title', $user->posts()->first()->title);

        // The same posts should be updated rather than be created twice
        $this->artisan('api:sync');

        $this->assertCount(1, Post::all());
    }

    /** @test */
    public function it_updates_comments_in_local_database()
    {
        $this->artisan('api:sync');

        $post = Post::first();

        $this->assertCount(1, $post->comments);
        $this->assertEquals('Some comment', $post->comments()->first()->body);

        // The same comments should be updated rather than be created twice
        $this->artisan('api:sync');

        $this->assertCount(1, Comment::all());
    }
}

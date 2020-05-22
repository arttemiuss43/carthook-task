<?php


namespace Tests\Requests;


use App\Api\CommentsRequest;
use App\Api\PostsRequest;
use App\Api\UsersRequest;
use Illuminate\Support\Collection;
use Tests\TestCase;

/**
 * @group api
 */
class ApiRequestTest extends TestCase
{
    /** @test */
    public function it_fetches_users_from_api()
    {
        try {
            $users = resolve(UsersRequest::class)->all();
        } catch (\Exception $e) {
            $this->fail('Failed to fetch users from an API. ' . $e->getMessage());
        }

        $this->assertInstanceOf(Collection::class, $users);
    }

    /** @test */
    public function it_fetches_posts_from_api()
    {
        try {
            $posts = resolve(PostsRequest::class)->all();
        } catch (\Exception $e) {
            $this->fail('Failed to fetch posts from an API. ' . $e->getMessage());
        }

        $this->assertInstanceOf(Collection::class, $posts);
    }

    /** @test */
    public function it_fetches_comments_from_api()
    {
        try {
            $comments = resolve(CommentsRequest::class)->all();
        } catch (\Exception $e) {
            $this->fail('Failed to fetch comments from an API. ' . $e->getMessage());
        }

        $this->assertInstanceOf(Collection::class, $comments);
    }
}

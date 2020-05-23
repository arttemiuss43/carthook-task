<?php


namespace Tests\Feature;


use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        factory(User::class)->create();
        factory(Post::class, 5)->create();

        $this->user = factory(User::class)->create();
        factory(Post::class, 10)->create([
            'user_id' => $this->user->id
        ]);
    }

    /** @test */
    public function it_returns_posts_that_belongs_to_a_given_user()
    {
        $this->get("api/users/{$this->user->id}/posts")
            ->assertStatus(200)
            ->assertJsonCount(10, 'posts');
    }

    /** @test */
    public function it_returns_404_if_user_is_not_found()
    {
        $notExistingUserId = $this->user->id + 1;

        $this->get("api/users/$notExistingUserId/posts")
            ->assertStatus(404);
    }
}

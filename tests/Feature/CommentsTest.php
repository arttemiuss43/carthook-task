<?php


namespace Tests\Feature;


use App\Comment;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Post
     */
    protected $post;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        factory(Post::class)->create();
        factory(Comment::class, 5)->create();

        $this->post = factory(Post::class)->create();

        factory(Comment::class, 10)->create([
            'post_id' => $this->post->id
        ]);
    }

    /** @test */
    public function it_returns_comments_that_belongs_to_a_given_post()
    {
        $this->get("api/users/{$this->user->id}/posts/{$this->post->id}/comments")
            ->assertStatus(200)
            ->assertJsonCount(10, 'comments');
    }

    /** @test */
    public function it_returns_404_if_user_is_not_found()
    {
        $notExistingUserId = $this->user->id + 1;

        $this->get("api/users/$notExistingUserId/posts/{$this->post->id}")
            ->assertStatus(404);
    }

    /** @test */
    public function it_returns_404_if_a_post_doesnt_belong_to_a_user()
    {
        $john = factory(User::class)->create();

        $this->get("api/users/{$john->id}/posts/{$this->post->id}")
            ->assertStatus(404);
    }
}

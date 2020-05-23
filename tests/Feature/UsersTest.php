<?php


namespace Tests\Feature;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_all_users()
    {
        factory(User::class, 10)->create();

        $this->get('api/users')
            ->assertStatus(200)
            ->assertJsonCount(10, 'users');
    }

    /** @test */
    public function it_returns_user_by_id()
    {
        $user = factory(User::class)->create();

        $this->get("api/users/{$user->id}")
            ->assertStatus(200)
            ->assertJson([
                'user' => [
                    'name' => $user->name
                ]
            ]);
    }

    /** @test */
    public function it_returns_404_if_user_is_not_found()
    {
        $this->get('api/users/1')
            ->assertStatus(404);
    }
}

<?php


namespace App\Console\Commands\Syncs;


use App\Api\PostsRequest;
use App\Post;
use App\User;

class PostsSync extends Sync
{
    public function handle(PostsRequest $postsRequest)
    {
        foreach ($this->apiPosts($postsRequest) as $userId => $apiUserPosts) {
            $user = User::where('remote_id', $userId)->first();

            $this->updatePosts($apiUserPosts->take($this->limits['posts']), $user);
        }
    }

    protected function apiPosts($postsRequest)
    {
        return $postsRequest->all()->whereIn(
            'userId',
            User::pluck('remote_id')->toArray()
        )->groupBy('userId')->take($this->limits['users']);
    }

    protected function updatePosts($posts, $user)
    {
        foreach ($posts as $apiPost) {
            $post = Post::where('remote_id', $apiPost['id'])->first();

            if ($post) {
                $post->update($this->postData($apiPost));
            } else {
                $user->posts()->create($this->postData($apiPost));
            }
        }
    }

    protected function postData($post)
    {
        return [
            'remote_id' => $post['id'],
            'title' => $post['title'],
            'body' => $post['body']
        ];
    }
}

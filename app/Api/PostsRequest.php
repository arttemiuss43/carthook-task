<?php


namespace App\Api;


use Illuminate\Support\Collection;

class PostsRequest extends ApiRequest
{
    /**
     * Fetch all posts from the api.
     *
     * @return Collection
     */
    public function all()
    {
        $results = $this->http->get('posts')->json();

        return collect($results)->map(function ($post) {
            return [
                'id' => $post['id'],
                'userId' => $post['userId'],
                'title' => $post['title'],
                'body' => $post['body']
            ];
        });
    }
}

<?php


namespace App\Api;


use Illuminate\Support\Collection;

class CommentsRequest extends ApiRequest
{
    /**
     * Fetch all comments from the API.
     *
     * @return Collection
     */
    public function all()
    {
        $results = $this->http->get('comments')->json();

        return collect($results)->map(function ($comment) {
            return [
                'id' => $comment['id'],
                'postId' => $comment['postId'],
                'name' => $comment['name'],
                'email' => $comment['email'],
                'body' => $comment['body']
            ];
        });
    }
}

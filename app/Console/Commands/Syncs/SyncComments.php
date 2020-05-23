<?php


namespace App\Console\Commands\Syncs;


use App\Api\CommentsRequest;
use App\Comment;
use App\Post;

class SyncComments extends Sync
{
    public function handle(CommentsRequest $commentsRequest)
    {
        foreach ($this->apiComments($commentsRequest) as $postId => $apiPostComments) {
            $post = Post::where('remote_id', $postId)->first();

            $this->updateComments($apiPostComments, $post);
        }
    }

    protected function apiComments($commentsRequest)
    {
        return $commentsRequest->all()->whereIn(
            'postId',
            Post::pluck('remote_id')->toArray()
        )->groupBy('postId')->take($this->limits['users']);
    }

    protected function updateComments($comments, $post)
    {
        foreach ($comments as $apiComment) {
            $comment = Comment::where('remote_id', $apiComment['id'])->first();

            if ($comment) {
                $comment->update($this->commentData($apiComment));
            } else {
                $post->comments()->create($this->commentData($apiComment));
            }
        }
    }

    protected function commentData($comment)
    {
        return [
            'remote_id' => $comment['id'],
            'name' => $comment['name'],
            'email' => $comment['email'],
            'body' => $comment['body']
        ];
    }
}

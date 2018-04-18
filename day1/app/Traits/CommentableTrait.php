<?php

namespace App\Traits;

use App\Comment;
use Illuminate\Database\Eloquent\Model;

trait CommentableTrait
{
    /**
     * Return all comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany('\App\Comment', 'commentable');
    }

    /**
     * Add comment a new comment.
     *
     * @param  string $body
     * @param  Model  $user
     * @return bool
     */
    public function addComment($body, Model $user)
    {
        $comment = new Comment;

        // Populate comment
        $comment->user_id = $user->id;
        $comment->body = $body;

        return $this->comments()->save($comment);
    }
}
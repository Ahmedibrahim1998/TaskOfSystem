<?php

namespace App\Actions\Comments;

use App\Models\Comment;

/**
 * Action: إضافة تعليق على منشور.
 */
class CreateCommentAction
{
    public function execute(int $userId, int $postId, string $body): Comment
    {
        $comment = Comment::query()->create([
            'user_id' => $userId,
            'post_id' => $postId,
            'body'    => $body,
        ]);

        return $comment->load('user');
    }
}

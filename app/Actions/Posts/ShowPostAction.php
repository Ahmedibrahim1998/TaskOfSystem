<?php

namespace App\Actions\Posts;

use App\Models\Post;

/**
 * Action: عرض منشور واحد محمَّل بعلاقاته.
 */
class ShowPostAction
{
    public function execute(Post $post): Post
    {
        return $post->load(['user', 'comments.user']);
    }
}

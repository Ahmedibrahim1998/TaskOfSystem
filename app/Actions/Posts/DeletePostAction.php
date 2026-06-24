<?php

namespace App\Actions\Posts;

use App\Models\Post;

/**
 * Action: حذف منشور.
 */
class DeletePostAction
{
    public function execute(Post $post): void
    {
        $post->delete();
    }
}

<?php

namespace App\Actions\Posts;

use App\Models\Post;

/**
 * Action: تحديث منشور موجود.
 */
class UpdatePostAction
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(Post $post, array $data): Post
    {
        $post->update($data);

        return $post->load(['user', 'comments.user']);
    }
}

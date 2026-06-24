<?php

namespace App\Actions\Posts;

use App\Models\Post;

/**
 * Action: إنشاء منشور جديد لمستخدم.
 */
class CreatePostAction
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(int $userId, array $data): Post
    {
        $data['user_id'] = $userId;

        $post = Post::query()->create($data);

        return $post->load(['user', 'comments.user']);
    }
}

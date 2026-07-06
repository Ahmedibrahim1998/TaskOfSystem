<?php

namespace App\Services;

use App\DTOs\CommentData;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * طبقة منطق العمل للتعليقات.
 */
class CommentService
{
    public function __construct(
        private readonly CommentRepositoryInterface $comments,
    ) {
    }

    /**
     * @return LengthAwarePaginator<int, Comment>
     */
    public function listForPost(int $postId, int $perPage = 10): LengthAwarePaginator
    {
        return $this->comments->paginateByPost($postId, $perPage);
    }

    /**
     * يضيف تعليق كتبه المستخدم على منشور ويرجّعه محمَّل بالكاتب.
     */
    public function create(User $author, Post $post, CommentData $data): Comment
    {
        $comment = $this->comments->create([
            'user_id' => $author->id,
            'post_id' => $post->id,
            'body'    => $data->body,
        ]);

        return $comment->load('user');
    }
}

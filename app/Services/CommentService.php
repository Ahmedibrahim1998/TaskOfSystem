<?php

namespace App\Services;

use App\Models\Comment;
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
     * يضيف تعليق على منشور ويرجّعه محمَّل بالكاتب.
     */
    public function create(int $userId, int $postId, string $body): Comment
    {
        $comment = $this->comments->create([
            'user_id' => $userId,
            'post_id' => $postId,
            'body'    => $body,
        ]);

        return $comment->load('user');
    }
}

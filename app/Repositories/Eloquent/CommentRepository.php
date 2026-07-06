<?php

namespace App\Repositories\Eloquent;

use App\Models\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * تنفيذ مستودع التعليقات باستخدام Eloquent.
 */
class CommentRepository implements CommentRepositoryInterface
{
    /**
     * @return LengthAwarePaginator<int, Comment>
     */
    public function paginateByPost(int $postId, int $perPage = 10): LengthAwarePaginator
    {
        return Comment::query()
            ->with(['user', 'post'])
            ->where('post_id', $postId)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Comment
    {
        return Comment::query()->create($data);
    }
}

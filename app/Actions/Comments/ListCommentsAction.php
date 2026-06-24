<?php

namespace App\Actions\Comments;

use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Action: جلب تعليقات منشور معيّن مقسّمة لصفحات.
 */
class ListCommentsAction
{
    /**
     * @return LengthAwarePaginator<int, Comment>
     */
    public function execute(int $postId, int $perPage = 10): LengthAwarePaginator
    {
        return Comment::query()
            ->with(['user', 'post'])
            ->where('post_id', $postId)
            ->latest()
            ->paginate($perPage);
    }
}

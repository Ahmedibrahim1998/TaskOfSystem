<?php

namespace App\Repositories\Contracts;

use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * عقد مستودع التعليقات.
 */
interface CommentRepositoryInterface
{
    /**
     * يرجّع تعليقات منشور معيّن مقسّمة لصفحات.
     *
     * @return LengthAwarePaginator<int, Comment>
     */
    public function paginateByPost(int $postId, int $perPage = 10): LengthAwarePaginator;

    /**
     * ينشئ تعليق جديد.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Comment;
}
